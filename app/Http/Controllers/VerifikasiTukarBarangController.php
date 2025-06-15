<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\BarangModel;
use App\Models\PenukaranBarangModel;
use App\Models\PenggunaModel; 

class VerifikasiTukarBarangController extends Controller
{
    /**
     * Display the verification page
     */
    public function index()
    {
        return view('admin.verifikasi-penukaran-barang');
    }

    /**
     * Search for exchange by verification code
     */
    public function cariKode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode_redeem' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kode verifikasi harus diisi',
                    'errors' => $validator->errors()
                ], 400);
            }

            $penukaran = PenukaranBarangModel::with(['barang', 'pengguna'])
                ->where('kode_redeem', $request->kode_redeem)
                ->first();

            if (!$penukaran) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kode verifikasi tidak ditemukan'
                ], 404);
            }

            // Check if already redeemed
            if ($penukaran->status_redeem == true) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kode verifikasi sudah digunakan sebelumnya',
                    'data' => [
                        'penukaran' => $penukaran,
                        'sudah_digunakan' => true
                    ]
                ], 400);
            }

            return response()->json([
                'status' => true,
                'message' => 'Kode verifikasi ditemukan',
                'data' => [
                    'penukaran' => $penukaran,
                    'sudah_digunakan' => false
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error in cariKode: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mencari kode verifikasi'
            ], 500);
        }
    }

    /**
     * Verify the exchange
     */
    public function verifikasi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_penukaran_barang' => 'required|string|exists:penukaran_barang,id_penukaran_barang'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $validator->errors()
                ], 400);
            }

            $penukaran = PenukaranBarangModel::with(['barang', 'pengguna'])
                ->where('id_penukaran_barang', $request->id_penukaran_barang)
                ->first();

            if (!$penukaran) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data penukaran tidak ditemukan'
                ], 404);
            }

            // Check if already verified
            if ($penukaran->status_redeem == true) {
                return response()->json([
                    'status' => false,
                    'message' => 'Penukaran sudah diverifikasi sebelumnya'
                ], 400);
            }

            // Check stock availability
            $barang = $penukaran->barang;
            if ($barang->stok <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Stok barang tidak mencukupi'
                ], 400);
            }

            // Update status and reduce stock
            $penukaran->status_redeem = true;
            $penukaran->save();

            // Reduce stock
            $barang->stok = $barang->stok - 1;
            $barang->save();

            return response()->json([
                'status' => true,
                'message' => 'Penukaran berhasil diverifikasi',
                'data' => $penukaran->load(['barang', 'pengguna'])
            ]);

        } catch (Exception $e) {
            Log::error('Error in verifikasi: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat verifikasi penukaran'
            ], 500);
        }
    }

    /**
     * Get all pending exchanges for DataTables
     */
    public function getPendingExchanges(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = PenukaranBarangModel::with(['barang', 'pengguna'])
                    ->where('status_redeem', false)
                    ->orderBy('waktu', 'desc')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('nama_pengguna', function($row) {
                        return $row->pengguna ? $row->pengguna->nama_lengkap : '-';
                    })
                    ->addColumn('nama_barang', function($row) {
                        return $row->barang ? $row->barang->nama_barang : '-';
                    })
                    ->addColumn('waktu_formatted', function($row) {
                        return date('d/m/Y H:i', strtotime($row->waktu));
                    })
                    ->addColumn('action', function($row) {
                        return '<button type="button" class="btn-detail px-3 py-1 bg-[#3D8D7A] text-white rounded text-sm hover:bg-[#3D8D7A]" data-id="'.$row->id_penukaran_barang.'">
                                    Detail
                                </button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (Exception $e) {
            Log::error('Error in getPendingExchanges: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan'], 500);
        }
    }

    /**
     * Get exchange detail
     */
    public function getDetail($id)
    {
        try {
            $penukaran = PenukaranBarangModel::with(['barang', 'pengguna'])
                ->where('id_penukaran_barang', $id)
                ->first();

            if (!$penukaran) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $penukaran
            ]);

        } catch (Exception $e) {
            Log::error('Error in getDetail: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil detail'
            ], 500);
        }
    }
}