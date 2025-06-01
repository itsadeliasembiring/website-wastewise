<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\DonasiModel;
use App\Models\PenukaranDonasiModel;
use App\Models\PenggunaModel; 

class TransaksiDonasiController extends Controller
{
    protected $DonasiModel;
    protected $PenukaranDonasiModel;

    public function __construct()
    {
        $this->DonasiModel = new DonasiModel;
        $this->PenukaranDonasiModel = new PenukaranDonasiModel;
    }
    
    public function kelolaDonasi(Request $request)
    {
        try {
            $donasi = $this->DonasiModel->get();
            $riwayat_penukaran = $this->PenukaranDonasiModel::with(['donasi', 'pengguna'])->get();

            return view("admin/penukaran-donasi", [
                'donasi' => $donasi, 
                'riwayat_penukaran' => $riwayat_penukaran
            ]);
        } catch (Exception $e) {
            Log::error('Kelola Donasi error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memuat data: " . $e->getMessage());
        }
    }

    public function donasiData(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        try {
            $donasi = $this->DonasiModel::query();

            return Datatables::of($donasi)
                ->addIndexColumn()
                ->addColumn('foto', function($row) {
                    if($row->foto && Storage::disk('public')->exists('donasi/'.$row->foto)) {
                        return '<img src="'.asset('storage/donasi/'.$row->foto).'" alt="Foto Donasi" class="w-16 h-16 object-cover rounded">';
                    }
                    return '<span class="text-gray-400">Tidak ada foto</span>';
                })
                ->addColumn('status_donasi', function($row) {
                    if($row->total_donasi <= 0) {
                        return '<span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Belum Ada Donasi</span>';
                    } else {
                        return '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Ada Donasi (Rp '.number_format($row->total_donasi, 0, ',', '.').')</span>';
                    }
                })
                ->addColumn('action', function($row) {
                    return '
                        <div class="flex space-x-2 items-center justify-center">
                            <button onclick="openEditModal(\''.$row->id_donasi.'\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button> 
                            <button onclick="openDeleteModal(\''.$row->id_donasi.'\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        ';
                })
                ->rawColumns(['foto', 'status_donasi', 'action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error('DataTables Donasi error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function riwayatPenukaranData(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        try {
            $riwayat = $this->PenukaranDonasiModel::query()
                     ->with(['donasi', 'pengguna'])
                     ->orderBy('waktu', 'desc');

            // Filter berdasarkan status redeem
            if(!empty($request->status) && $request->status != 'all') {
                if($request->status == 'true' || $request->status == '1') {
                    $riwayat = $riwayat->where('status_redeem', true);
                } elseif($request->status == 'false' || $request->status == '0') {
                    $riwayat = $riwayat->where('status_redeem', false);
                }
            }

            return Datatables::of($riwayat)
                ->addIndexColumn()
                ->addColumn('nama_donasi', function($row) {
                    return $row->donasi ? $row->donasi->nama_donasi : 'Donasi Tidak Ditemukan';
                })
                ->addColumn('nama_pengguna', function($row) {
                    return $row->pengguna ? $row->pengguna->nama_lengkap : 'Pengguna Tidak Ditemukan';
                })
                ->addColumn('waktu_formatted', function($row) {
                    return date('d/m/Y H:i:s', strtotime($row->waktu));
                })
                ->addColumn('jumlah_donasi_formatted', function($row) {
                    return 'Rp ' . number_format($row->jumlah_donasi, 0, ',', '.');
                })
                ->addColumn('status_badge', function($row) {
                    if($row->status_redeem) {
                        return '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Sudah Ditukar</span>';
                    } else {
                        return '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Belum Ditukar</span>';
                    }
                })
                ->rawColumns(['status_badge'])
                ->make(true);
        } catch (Exception $e) {
            Log::error('DataTables Riwayat Penukaran Donasi error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function addDonasi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_donasi' => 'required|string|max:255',
                'deskripsi_donasi' => 'required|string',
                'total_donasi' => 'nullable|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nama_donasi.required' => 'Nama donasi tidak boleh kosong!',
                'nama_donasi.max' => 'Nama donasi maksimal 255 karakter!',
                'deskripsi_donasi.required' => 'Deskripsi donasi tidak boleh kosong!',
                'total_donasi.numeric' => 'Total donasi harus berupa angka!',
                'total_donasi.min' => 'Total donasi tidak boleh negatif!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran gambar maksimal 2MB!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Generate a unique id_donasi
            $lastId = $this->DonasiModel->orderBy('id_donasi', 'desc')->first();
            $newId = 'D01';
            
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_donasi, 1));
                $newIdNum = $lastIdNum + 1;
                $newId = 'D' . str_pad($newIdNum, 2, '0', STR_PAD_LEFT);
            }
            
            $fotoName = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('donasi', $fotoName, 'public');
            }
            
            $donasi = new DonasiModel;
            $donasi->id_donasi = $newId;
            $donasi->nama_donasi = $request->input("nama_donasi");
            $donasi->deskripsi_donasi = $request->input("deskripsi_donasi");
            $donasi->total_donasi = $request->input("total_donasi") ?? 0;
            $donasi->foto = $fotoName;
            $donasi->save();
            
            return redirect()->back()->with("success", "Data donasi berhasil disimpan!");
        } catch (Exception $e) {
            Log::error('Add donasi error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function editDonasi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_donasi' => 'required|exists:donasi,id_donasi',
                'nama_donasi' => 'required|string|max:255',
                'deskripsi_donasi' => 'required|string',
                'total_donasi' => 'nullable|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'id_donasi.required' => 'ID donasi tidak ditemukan!',
                'id_donasi.exists' => 'ID donasi tidak valid!',
                'nama_donasi.required' => 'Nama donasi tidak boleh kosong!',
                'nama_donasi.max' => 'Nama donasi maksimal 255 karakter!',
                'deskripsi_donasi.required' => 'Deskripsi donasi tidak boleh kosong!',
                'total_donasi.numeric' => 'Total donasi harus berupa angka!',
                'total_donasi.min' => 'Total donasi tidak boleh negatif!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran gambar maksimal 2MB!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $donasi = $this->DonasiModel->where('id_donasi', $request->input('id_donasi'))->first();
            
            if (!$donasi) {
                return redirect()->back()->with("error", "Data donasi tidak ditemukan!");
            }
            
            $fotoName = $donasi->foto; 
            
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($donasi->foto && Storage::disk('public')->exists('donasi/'.$donasi->foto)) {
                    Storage::disk('public')->delete('donasi/'.$donasi->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('donasi', $fotoName, 'public');
            }
            
            $dataDonasi = [
                'nama_donasi' => $request->input('nama_donasi'),
                'deskripsi_donasi' => $request->input('deskripsi_donasi'),
                'total_donasi' => $request->input('total_donasi') ?? 0,
                'foto' => $fotoName
            ];
            
            $updateDonasi = $this->DonasiModel
                ->where('id_donasi', $request->input('id_donasi'))
                ->update($dataDonasi);
                
            if ($updateDonasi) {
                return redirect()->back()->with("success", "Data donasi berhasil diperbarui!");
            }
            
            return redirect()->back()->with("error", "Tidak ada perubahan data!");
        } catch (Exception $e) {
            Log::error('Edit donasi error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memperbarui data: " . $e->getMessage());
        }
    }

    public function deleteDonasi($id = null)
    {
        try {
            if (!$id) {
                return redirect()->back()->with("error", "ID donasi tidak ditemukan!");
            }
            
            // Check if donasi is being used in any penukaran
            $penukaranCount = $this->PenukaranDonasiModel->where('id_donasi', $id)->count();
            
            if ($penukaranCount > 0) {
                return redirect()->back()->with("error", "Donasi tidak dapat dihapus karena memiliki {$penukaranCount} riwayat penukaran!");
            }
            
            $donasi = $this->DonasiModel->where('id_donasi', $id)->first();
            
            if (!$donasi) {
                return redirect()->back()->with("error", "Data donasi tidak ditemukan!");
            }
            
            // Delete photo if exists
            if ($donasi->foto && Storage::disk('public')->exists('donasi/' . $donasi->foto)) {
                Storage::disk('public')->delete('donasi/' . $donasi->foto);
            }
            
            $hapus = $donasi->delete();
                
            if ($hapus) {
                return redirect()->back()->with("success", "Data donasi berhasil dihapus!");
            }
            
            return redirect()->back()->with("error", "Gagal menghapus data!");
        } catch (Exception $e) {
            Log::error('Delete donasi error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }

    // Add method to get single donasi data for edit modal
    public function getDonasi($id)
    {
        try {
            $donasi = $this->DonasiModel->where('id_donasi', $id)->first();
            
            if (!$donasi) {
                return response()->json(['error' => 'Donasi tidak ditemukan'], 404);
            }
            
            return response()->json(['data' => $donasi]);
        } catch (Exception $e) {
            Log::error('Get donasi error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data donasi'], 500);
        }
    }
}