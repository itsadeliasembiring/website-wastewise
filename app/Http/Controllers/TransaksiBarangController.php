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

class TransaksiBarangController extends Controller
{
    protected $BarangModel;
    protected $PenukaranBarangModel;

    public function __construct()
    {
        $this->BarangModel = new BarangModel;
        $this->PenukaranBarangModel = new PenukaranBarangModel;
    }
    
    public function kelolaBarang(Request $request)
    {
        try {
            $barang = $this->BarangModel->get();
            $riwayat_penukaran = $this->PenukaranBarangModel::with(['barang', 'pengguna'])->get();

            return view("admin/penukaran-barang", [
                'barang' => $barang, 
                'riwayat_penukaran' => $riwayat_penukaran
            ]);
        } catch (Exception $e) {
            Log::error('Kelola Barang error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memuat data: " . $e->getMessage());
        }
    }

    public function barangData(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        try {
            $barang = $this->BarangModel::query();

            return Datatables::of($barang)
                ->addIndexColumn()
                ->addColumn('foto', function($row) {
                    if($row->foto && Storage::disk('public')->exists('barang/'.$row->foto)) {
                        return '<img src="'.asset('storage/barang/'.$row->foto).'" alt="Foto Barang" class="w-16 h-16 object-cover rounded">';
                    }
                    return '<span class="text-gray-400">Tidak ada foto</span>';
                })
                ->addColumn('stok_status', function($row) {
                    if($row->stok <= 0) {
                        return '<span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Habis</span>';
                    } elseif($row->stok <= 5) {
                        return '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menipis ('.$row->stok.')</span>';
                    } else {
                        return '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Tersedia ('.$row->stok.')</span>';
                    }
                })
                ->addColumn('action', function($row) {
                    return '
                        <div class="flex space-x-2 items-center justify-center">
                            <button onclick="openEditModal(\''.$row->id_barang.'\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button> 
                            <button onclick="openDeleteModal(\''.$row->id_barang.'\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        ';
                })
                ->rawColumns(['foto', 'stok_status', 'action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error('DataTables Barang error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function riwayatPenukaranData(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        try {
            $riwayat = $this->PenukaranBarangModel::query()
                     ->with(['barang', 'pengguna'])
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
                ->addColumn('nama_barang', function($row) {
                    return $row->barang ? $row->barang->nama_barang : 'Barang Tidak Ditemukan';
                })
                ->addColumn('nama_pengguna', function($row) {
                    return $row->pengguna ? $row->pengguna->nama_lengkap : 'Pengguna Tidak Ditemukan';
                })
                ->addColumn('waktu_formatted', function($row) {
                    return date('d/m/Y H:i:s', strtotime($row->waktu));
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
            Log::error('DataTables Riwayat Penukaran error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function addBarang(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required|string|max:255',
                'bobot_poin' => 'required|numeric|min:0',
                'stok' => 'required|integer|min:0',
                'deskripsi_barang' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nama_barang.required' => 'Nama barang tidak boleh kosong!',
                'nama_barang.max' => 'Nama barang maksimal 255 karakter!',
                'bobot_poin.required' => 'Bobot poin tidak boleh kosong!',
                'bobot_poin.numeric' => 'Bobot poin harus berupa angka!',
                'bobot_poin.min' => 'Bobot poin tidak boleh negatif!',
                'stok.required' => 'Stok tidak boleh kosong!',
                'stok.integer' => 'Stok harus berupa angka bulat!',
                'stok.min' => 'Stok tidak boleh negatif!',
                'deskripsi_barang.required' => 'Deskripsi barang tidak boleh kosong!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran gambar maksimal 2MB!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Generate a unique id_barang
            $lastId = $this->BarangModel->orderBy('id_barang', 'desc')->first();
            $newId = 'B01';
            
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_barang, 1));
                $newIdNum = $lastIdNum + 1;
                $newId = 'B' . str_pad($newIdNum, 2, '0', STR_PAD_LEFT);
            }
            
            $fotoName = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('barang', $fotoName, 'public');
            }
            
            $barang = new BarangModel;
            $barang->id_barang = $newId;
            $barang->nama_barang = $request->input("nama_barang");
            $barang->bobot_poin = $request->input("bobot_poin");
            $barang->stok = $request->input("stok");
            $barang->deskripsi_barang = $request->input("deskripsi_barang");
            $barang->foto = $fotoName;
            $barang->save();
            
            return redirect()->back()->with("success", "Data barang berhasil disimpan!");
        } catch (Exception $e) {
            Log::error('Add barang error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function editBarang(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_barang' => 'required|exists:barang,id_barang',
                'nama_barang' => 'required|string|max:255',
                'bobot_poin' => 'required|numeric|min:0',
                'stok' => 'required|integer|min:0',
                'deskripsi_barang' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'id_barang.required' => 'ID barang tidak ditemukan!',
                'id_barang.exists' => 'ID barang tidak valid!',
                'nama_barang.required' => 'Nama barang tidak boleh kosong!',
                'nama_barang.max' => 'Nama barang maksimal 255 karakter!',
                'bobot_poin.required' => 'Bobot poin tidak boleh kosong!',
                'bobot_poin.numeric' => 'Bobot poin harus berupa angka!',
                'bobot_poin.min' => 'Bobot poin tidak boleh negatif!',
                'stok.required' => 'Stok tidak boleh kosong!',
                'stok.integer' => 'Stok harus berupa angka bulat!',
                'stok.min' => 'Stok tidak boleh negatif!',
                'deskripsi_barang.required' => 'Deskripsi barang tidak boleh kosong!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran gambar maksimal 2MB!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $barang = $this->BarangModel->where('id_barang', $request->input('id_barang'))->first();
            
            if (!$barang) {
                return redirect()->back()->with("error", "Data barang tidak ditemukan!");
            }
            
            $fotoName = $barang->foto; 
            
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($barang->foto && Storage::disk('public')->exists('barang/'.$barang->foto)) {
                    Storage::disk('public')->delete('barang/'.$barang->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('barang', $fotoName, 'public');
            }
            
            $dataBarang = [
                'nama_barang' => $request->input('nama_barang'),
                'bobot_poin' => $request->input('bobot_poin'),
                'stok' => $request->input('stok'),
                'deskripsi_barang' => $request->input('deskripsi_barang'),
                'foto' => $fotoName
            ];
            
            $updateBarang = $this->BarangModel
                ->where('id_barang', $request->input('id_barang'))
                ->update($dataBarang);
                
            if ($updateBarang) {
                return redirect()->back()->with("success", "Data barang berhasil diperbarui!");
            }
            
            return redirect()->back()->with("error", "Tidak ada perubahan data!");
        } catch (Exception $e) {
            Log::error('Edit barang error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memperbarui data: " . $e->getMessage());
        }
    }

    public function deleteBarang($id = null)
    {
        try {
            if (!$id) {
                return redirect()->back()->with("error", "ID barang tidak ditemukan!");
            }
            
            // Check if barang is being used in any penukaran
            $penukaranCount = $this->PenukaranBarangModel->where('id_barang', $id)->count();
            
            if ($penukaranCount > 0) {
                return redirect()->back()->with("error", "Barang tidak dapat dihapus karena memiliki {$penukaranCount} riwayat penukaran!");
            }
            
            $barang = $this->BarangModel->where('id_barang', $id)->first();
            
            if (!$barang) {
                return redirect()->back()->with("error", "Data barang tidak ditemukan!");
            }
            
            // Delete photo if exists
            if ($barang->foto && Storage::disk('public')->exists('barang/' . $barang->foto)) {
                Storage::disk('public')->delete('barang/' . $barang->foto);
            }
            
            $hapus = $barang->delete();
                
            if ($hapus) {
                return redirect()->back()->with("success", "Data barang berhasil dihapus!");
            }
            
            return redirect()->back()->with("error", "Gagal menghapus data!");
        } catch (Exception $e) {
            Log::error('Delete barang error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }

    // Add method to get single barang data for edit modal
    public function getBarang($id)
    {
        try {
            $barang = $this->BarangModel->where('id_barang', $id)->first();
            
            if (!$barang) {
                return response()->json(['error' => 'Barang tidak ditemukan'], 404);
            }
            
            return response()->json(['data' => $barang]);
        } catch (Exception $e) {
            Log::error('Get barang error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data barang'], 500);
        }
    }
}