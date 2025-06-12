<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\ArtikelModel;

class ArtikelController extends Controller
{
    protected $ArtikelModel;

    public function __construct()
    {
        $this->ArtikelModel = new ArtikelModel;
    }
    
    // ========== ADMIN METHODS ==========
    
    public function kelolaArtikel(Request $request)
    {
        $artikel = $this->ArtikelModel::all();

        return view("admin/kelola-artikel", [
            'artikel' => $artikel
        ]);
    }

    public function artikelData(Request $request)
    {
        if(request()->ajax()) {
            $artikel = $this->ArtikelModel::query();

            // Filter by date range if specified
            if(!empty($request->start_date) && !empty($request->end_date)) {
                $artikel = $artikel->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }

            try {
                return Datatables::of($artikel)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '
                            <div class="flex space-x-2 items-center justify-center">
                                <button onclick="showDetail(\'' . $row->id_artikel . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick="editArtikel(\'' . $row->id_artikel . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button> 
                                <button onclick="confirmDelete(\'' . $row->id_artikel . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        ';
                    })
                    ->addColumn('formatted_created_date', function($row) {
                        return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y H:i');
                    })
                    ->addColumn('excerpt', function($row) {
                        return \Str::limit(strip_tags($row->detail_artikel), 100);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (Exception $e) {
                \Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function addArtikel(Request $request)
    {
        try {
            $request->validate([
                'judul_artikel' => 'required|string|max:255',
                'detail_artikel' => 'required|string',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'judul_artikel.required' => 'Judul artikel tidak boleh kosong!',
                'judul_artikel.max' => 'Judul artikel maksimal 255 karakter!',
                'detail_artikel.required' => 'Detail artikel tidak boleh kosong!',
                'foto.required' => 'Foto artikel tidak boleh kosong!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran foto maksimal 2MB!',
            ]);

            // Generate unique ID
            $lastArtikel = $this->ArtikelModel->orderBy('id_artikel', 'desc')->first();
            $newArtikelId = 'A0001';
            if ($lastArtikel) {
                $lastIdNum = intval(substr($lastArtikel->id_artikel, 1));
                $newIdNum = $lastIdNum + 1;
                $newArtikelId = 'A' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }

            // Handle file upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('artikel', 'public');
            }

            // Create artikel
            $artikel = new ArtikelModel;
            $artikel->id_artikel = $newArtikelId;
            $artikel->judul_artikel = $request->input("judul_artikel");
            $artikel->detail_artikel = $request->input("detail_artikel");
            $artikel->foto = $fotoPath;
            $artikel->created_at = now();
            $artikel->updated_at = now();
            $artikel->save();

            return redirect()->route('kelola-artikel')->with('success', 'Data artikel berhasil disimpan!');

        } catch (Exception $e) {
            \Log::error('Add artikel error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function getArtikel($id)
    {
        try {
            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();

            if (!$artikel) {
                return response()->json([
                    'success' => false,
                    'message' => 'Artikel tidak ditemukan!'
                ], 404);
            }

            // Tambahkan URL gambar
            $artikel->foto_url = $artikel->foto ? asset('storage/' . $artikel->foto) : null;

            return response()->json([
                'success' => true,
                'data' => $artikel
            ]);

        } catch (Exception $e) {
            \Log::error('Get artikel error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data artikel!'
            ], 500);
        }
    }

    public function editArtikel(Request $request)
    {
        try {
            $request->validate([
                'id_artikel' => 'required|exists:artikel,id_artikel',
                'judul_artikel' => 'required|string|max:255',
                'detail_artikel' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'judul_artikel.required' => 'Judul artikel tidak boleh kosong!',
                'judul_artikel.max' => 'Judul artikel maksimal 255 karakter!',
                'detail_artikel.required' => 'Detail artikel tidak boleh kosong!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran foto maksimal 2MB!',
            ]);

            $artikel = $this->ArtikelModel->where('id_artikel', $request->input('id_artikel'))->first();
            
            if (!$artikel) {
                return redirect()->route('kelola-artikel')->with('error', 'Artikel tidak ditemukan!');
            }

            // Handle file upload
            $fotoPath = $artikel->foto; // Keep existing photo by default
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($artikel->foto && Storage::disk('public')->exists($artikel->foto)) {
                    Storage::disk('public')->delete($artikel->foto);
                }
                $fotoPath = $request->file('foto')->store('artikel', 'public');
            }

            // Update artikel data
            $artikelData = [
                'judul_artikel' => $request->input('judul_artikel'),
                'detail_artikel' => $request->input('detail_artikel'),
                'foto' => $fotoPath,
                'updated_at' => now(),
            ];

            $updateArtikel = $this->ArtikelModel
                ->where('id_artikel', $request->input('id_artikel'))
                ->update($artikelData);

            if ($updateArtikel) {
                return redirect()->route('kelola-artikel')->with('success', 'Data artikel berhasil diperbarui!');
            }

            return redirect()->back()->with('error', 'Tidak ada perubahan data!');

        } catch (Exception $e) {
            \Log::error('Update artikel error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function deleteArtikel($id = null)
    {
        try {
            if (!$id) {
                return redirect()->route('kelola-artikel')->with('error', 'ID artikel tidak ditemukan!');
            }

            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();

            if (!$artikel) {
                return redirect()->route('kelola-artikel')->with('error', 'Artikel tidak ditemukan!');
            }

            // Delete photo file if exists
            if ($artikel->foto && Storage::disk('public')->exists($artikel->foto)) {
                Storage::disk('public')->delete($artikel->foto);
            }

            // Delete artikel
            $hapus = $artikel->delete();

            if ($hapus) {
                return redirect()->route('kelola-artikel')->with('success', 'Data artikel berhasil dihapus!');
            }

            return redirect()->route('kelola-artikel')->with('error', 'Gagal menghapus data!');

        } catch (Exception $e) {
            \Log::error('Delete artikel error: ' . $e->getMessage());
            return redirect()->route('kelola-artikel')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function detailArtikel($id)
    {
        try {
            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();
            
            if (!$artikel) {
                return redirect()->route('kelola-artikel')->with('error', 'Artikel tidak ditemukan!');
            }

            return view('admin.kelola-artikel-detail', [
                'artikel' => $artikel
            ]);

        } catch (Exception $e) {
            \Log::error('Detail artikel error: ' . $e->getMessage());
            return redirect()->route('kelola-artikel')->with('error', 'Gagal menampilkan detail artikel!');
        }
    }

    public function showEditArtikel($id)
    {
        try {
            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();
            
            if (!$artikel) {
                return redirect()->route('kelola-artikel')->with('error', 'Artikel tidak ditemukan!');
            }

            return view('admin.kelola-artikel-edit', [
                'artikel' => $artikel
            ]);

        } catch (Exception $e) {
            \Log::error('Show edit artikel error: ' . $e->getMessage());
            return redirect()->route('kelola-artikel')->with('error', 'Gagal menampilkan form edit artikel!');
        }
    }

    // ========== USER/PUBLIC METHODS ==========
    
    /**
     * Halaman beranda edukasi dengan daftar artikel
     */
    public function berandaEdukasi()
    {
        try {
            // Ambil 3 artikel terbaru untuk ditampilkan di beranda
            $artikel = $this->ArtikelModel->orderBy('created_at', 'desc')->limit(3)->get();
            // dd($artikel);
            return view('edukasi.beranda-edukasi', [
                'artikel' => $artikel
            ]);

        } catch (Exception $e) {
            \Log::error('Beranda edukasi error: ' . $e->getMessage());
            return view('edukasi.beranda-edukasi', [
                'artikel' => collect([]) // Empty collection jika error
            ]);
        }
    }

    /**
     * Halaman daftar semua artikel
     */
    public function daftarArtikel(Request $request)
    {
        try {
            $query = $this->ArtikelModel->orderBy('created_at', 'desc');

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul_artikel', 'like', '%' . $search . '%')
                      ->orWhere('detail_artikel', 'like', '%' . $search . '%');
                });
            }

            // Pagination
            $artikel = $query->paginate(6); // 6 artikel per halaman

            return view('edukasi/daftar-artikel', [
                'artikel' => $artikel,
                'search' => $request->search
            ]);

        } catch (Exception $e) {
            \Log::error('Daftar artikel error: ' . $e->getMessage());
            return view('edukasi/daftar-artikel', [
                'artikel' => $this->ArtikelModel->paginate(6),
                'search' => $request->search
            ]);
        }
    }

    /**
     * Halaman detail artikel untuk pengguna
     */
    public function detailArtikelPengguna($id)
    {
        try {
            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();
            
            if (!$artikel) {
                return redirect()->route('beranda-edukasi')->with('error', 'Artikel tidak ditemukan!');
            }

            // Ambil 2 artikel lainnya untuk "Baca Artikel Lainnya" (exclude artikel saat ini)
            $artikelLainnya = $this->ArtikelModel
                ->where('id_artikel', '!=', $id)
                ->orderBy('created_at', 'desc')
                ->limit(2)
                ->get();

            return view('edukasi/detail-artikel', [
                'artikel' => $artikel,
                'artikelLainnya' => $artikelLainnya
            ]);

        } catch (Exception $e) {
            \Log::error('Detail artikel pengguna error: ' . $e->getMessage());
            return redirect()->route('beranda-edukasi')->with('error', 'Gagal menampilkan detail artikel!');
        }
    }
}