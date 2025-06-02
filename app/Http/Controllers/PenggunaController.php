<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\PenggunaModel;
use App\Models\AkunModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;

class PenggunaController extends Controller
{
    protected $PenggunaModel;
    protected $AkunModel;
    protected $KelurahanModel;
    protected $KecamatanModel;

    public function __construct()
    {
        $this->PenggunaModel = new PenggunaModel;
        $this->AkunModel = new AkunModel;
        $this->KelurahanModel = new KelurahanModel;
        $this->KecamatanModel = new KecamatanModel;
    }
    
    public function kelolaPengguna(Request $request)
    {
        $pengguna = $this->PenggunaModel::query()
            ->with(['akun', 'kelurahan.kecamatan'])
            ->get();

        $kelurahan = $this->KelurahanModel->with('kecamatan')->get();
        $kecamatan = $this->KecamatanModel->get();

        return view("admin/kelola-pengguna", [
            'pengguna' => $pengguna, 
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan
        ]);
    }

    public function penggunaData(Request $request)
    {
        if(request()->ajax()) {
            $pengguna = $this->PenggunaModel::query()
                ->with(['akun', 'kelurahan.kecamatan']);

            // Filter by gender if specified
            if(!empty($request->gender) && $request->gender != 'all') {
                $pengguna = $pengguna->where('jenis_kelamin', $request->gender);
            }

            try {
                return Datatables::of($pengguna)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        return '
                            <div class="flex space-x-2 items-center justify-center">
                                <button onclick="showDetail(\'' . $row->id_pengguna . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick="editPengguna(\'' . $row->id_pengguna . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button> 
                                <button onclick="confirmDelete(\'' . $row->id_pengguna . '\')" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        ';
                    })
                    ->addColumn('formatted_birth_date', function($row) {
                        return \Carbon\Carbon::parse($row->tanggal_lahir)->format('d/m/Y');
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

    public function addPengguna(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'required|date',
                'nomor_telepon' => 'required|string|max:20',
                'email' => 'required|email|unique:akun,email',
                'password' => 'required|min:6',
                'total_poin' => 'nullable|integer|min:0',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'detail_alamat' => 'nullable|string',
                'id_kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            ], [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong!',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong!',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
                'nomor_telelon.required' => 'Nomor telepon tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Format email tidak valid!',
                'email.unique' => 'Email sudah terdaftar!',
                'password.required' => 'Password tidak boleh kosong!',
                'password.min' => 'Password minimal 6 karakter!',
                'foto.required' => 'Foto tidak boleh kosong!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran foto maksimal 2MB!',
                'id_kelurahan.required' => 'Kelurahan tidak boleh kosong!',
            ]);

            // Generate unique IDs
            $lastAkun = $this->AkunModel->orderBy('id_akun', 'desc')->first();
            $newAkunId = 'U0001';
            if ($lastAkun) {
                $lastIdNum = intval(substr($lastAkun->id_akun, 1));
                $newIdNum = $lastIdNum + 1;
                $newAkunId = 'U' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }
            

            $lastPengguna = $this->PenggunaModel->orderBy('id_pengguna', 'desc')->first();
            $newPenggunaId = 'PG0001';
            if ($lastPengguna) {
                $lastIdNum = intval(substr($lastPengguna->id_pengguna, 2));
                $newIdNum = $lastIdNum + 1;
                $newPenggunaId = 'PG' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }

            // Create akun first
            $akun = new AkunModel;
            $akun->id_akun = $newAkunId;
            $akun->email = $request->input("email");
            $akun->password = bcrypt($request->input("password"));
            $akun->id_level = '3'; // Assuming level 3 is for customers
            $akun->email_verified_at = now();
            $akun->save();

            // Handle file upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('pengguna', 'public');
            }

            // Create pengguna
            $pengguna = new PenggunaModel;
            $pengguna->id_pengguna = $newPenggunaId;
            $pengguna->nama_lengkap = $request->input("nama_lengkap");
            $pengguna->jenis_kelamin = $request->input("jenis_kelamin");
            $pengguna->tanggal_lahir = $request->input("tanggal_lahir");
            $pengguna->nomor_telepon = $request->input("nomor_telepon");
            $pengguna->total_poin = $request->input("total_poin", 0);
            $pengguna->foto = $fotoPath;
            $pengguna->detail_alamat = $request->input("detail_alamat");
            $pengguna->id_akun = $newAkunId;
            $pengguna->id_kelurahan = $request->input("id_kelurahan");
            $pengguna->save();

            return response()->json([
                'success' => true,
                'message' => 'Data pengguna berhasil disimpan!'
            ]);

        } catch (Exception $e) {
            \Log::error('Add pengguna error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPengguna($id)
    {
        try {
            $pengguna = $this->PenggunaModel->with(['akun', 'kelurahan.kecamatan'])
                ->where('id_pengguna', $id)
                ->first();

            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan!'
                ], 404);
            }

            // Tambahkan URL gambar di sini
            $pengguna->foto_url = $pengguna->foto ? asset('storage/' . $pengguna->foto) : null;

            return response()->json([
                'success' => true,
                'data' => $pengguna
            ]);

        } catch (Exception $e) {
            \Log::error('Get pengguna error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pengguna!'
            ], 500);
        }
    }


    public function editPengguna(Request $request)
    {
        try {
            $request->validate([
                'id_pengguna' => 'required|exists:pengguna,id_pengguna',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'required|date',
                'nomor_telepon' => 'required|string|max:20',
                'email' => 'required|email',
                'password' => 'nullable|min:6',
                'total_poin' => 'nullable|integer|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'detail_alamat' => 'nullable|string',
                'id_kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            ], [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong!',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong!',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
                'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Format email tidak valid!',
                'password.min' => 'Password minimal 6 karakter!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif!',
                'foto.max' => 'Ukuran foto maksimal 2MB!',
                'id_kelurahan.required' => 'Kelurahan tidak boleh kosong!',
            ]);

            $pengguna = $this->PenggunaModel->with('akun')->where('id_pengguna', $request->input('id_pengguna'))->first();
            
            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan!'
                ], 404);
            }

            // Check if email is already used by other account
            $existingAccount = $this->AkunModel
                ->where('email', $request->input('email'))
                ->where('id_akun', '!=', $pengguna->id_akun)
                ->first();
                
            if ($existingAccount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan oleh akun lain!'
                ], 400);
            }

            // Update akun data
            $akunData = [
                'email' => $request->input('email')
            ];
            
            if ($request->filled('password')) {
                $akunData['password'] = bcrypt($request->input('password'));
            }

            $this->AkunModel->where('id_akun', $pengguna->id_akun)->update($akunData);

            // Handle file upload
            $fotoPath = $pengguna->foto; // Keep existing photo by default
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($pengguna->foto && Storage::disk('public')->exists($pengguna->foto)) {
                    Storage::disk('public')->delete($pengguna->foto);
                }
                $fotoPath = $request->file('foto')->store('pengguna', 'public');
            }

            // Update pengguna data
            $penggunaData = [
                'nama_lengkap' => $request->input('nama_lengkap'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'total_poin' => $request->input('total_poin', 0),
                'foto' => $fotoPath,
                'detail_alamat' => $request->input('detail_alamat'),
                'id_kelurahan' => $request->input('id_kelurahan'),
            ];

            $updatePengguna = $this->PenggunaModel
                ->where('id_pengguna', $request->input('id_pengguna'))
                ->update($penggunaData);

            if ($updatePengguna) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna berhasil diperbarui!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan data!'
            ], 400);

        } catch (Exception $e) {
            \Log::error('Edit pengguna error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deletePengguna($id = null)
    {
        try {
            if (!$id) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID pengguna tidak ditemukan!'
                ], 400);
            }

            $pengguna = $this->PenggunaModel->where('id_pengguna', $id)->first();

            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan!'
                ], 404);
            }

            // Delete photo file if exists
            if ($pengguna->foto && Storage::disk('public')->exists($pengguna->foto)) {
                Storage::disk('public')->delete($pengguna->foto);
            }

            // Delete akun related to this pengguna
            if ($pengguna->id_akun) {
                $this->AkunModel->where('id_akun', $pengguna->id_akun)->delete();
            }

            // Delete pengguna
            $hapus = $pengguna->delete();

            if ($hapus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna berhasil dihapus!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data!'
            ], 500);

        } catch (Exception $e) {
            \Log::error('Delete pengguna error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

 public function showProfile()
    {
        try {
            // Debug: Check if user is authenticated
            if (!Auth::check()) {
                \Log::warning('User not authenticated, redirecting to login');
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
            }

            // Get authenticated user
            $user = Auth::user();
            
            // Debug: Log user data
            \Log::info('Authenticated user:', [
                'id_akun' => $user->id_akun ?? 'null',
                'email' => $user->email ?? 'null',
                'id_level' => $user->id_level ?? 'null'
            ]);
            
            // Pastikan user adalah pengguna (level 3)
            if (!$user->isPengguna()) {
                \Log::warning('User is not pengguna level', ['id_level' => $user->id_level]);
                return redirect()->back()->with('error', 'Akses ditolak! Anda bukan pengguna.');
            }
            
            // Find pengguna by akun ID
            $pengguna = $this->PenggunaModel->with(['akun', 'kelurahan.kecamatan'])
                ->where('id_akun', $user->id_akun)
                ->first();

            // If pengguna not found, try alternative approach
            if (!$pengguna) {
                \Log::info('Pengguna not found by id_akun, trying alternative approach');
                
                // Maybe the relationship is different, try finding by email
                $pengguna = $this->PenggunaModel->with(['akun', 'kelurahan.kecamatan'])
                    ->whereHas('akun', function($query) use ($user) {
                        $query->where('email', $user->email);
                    })
                    ->first();
            }

            if (!$pengguna) {
                \Log::error('Pengguna not found for user:', [
                    'user_id' => $user->id_akun ?? $user->id, 
                    'email' => $user->email
                ]);
                
                // Debug: Check if pengguna table has data
                $allPengguna = $this->PenggunaModel->with('akun')->get();
                \Log::info('All pengguna in database:', $allPengguna->toArray());
                
                return redirect()->back()->with('error', 'Profil pengguna tidak ditemukan! Silakan hubungi administrator.');
            }

            // Get kelurahan and kecamatan data
            $kelurahan = $this->KelurahanModel->with('kecamatan')->get();
            $kecamatan = $this->KecamatanModel->get();

            // Debug: Log retrieved data
            \Log::info('Profile data loaded:', [
                'pengguna_id' => $pengguna->id_pengguna,
                'nama' => $pengguna->nama_lengkap,
                'kelurahan_count' => $kelurahan->count(),
                'kecamatan_count' => $kecamatan->count()
            ]);

            return view('pengguna.ubah-profil', [
                'pengguna' => $pengguna,
                'kelurahan' => $kelurahan,
                'kecamatan' => $kecamatan
            ]);

        } catch (Exception $e) {
            \Log::error('Show profile error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user' => Auth::check() ? Auth::user()->toArray() : 'not authenticated'
            ]);
            return redirect()->back()->with('error', 'Gagal memuat profil: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            // Ambil ID pengguna yang sedang login
            $userId = auth()->user()->id_akun;
            
            $pengguna = $this->PenggunaModel->where('id_akun', $userId)->first();
            
            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan!'
                ], 404);
            }

            // Set id_pengguna untuk validasi
            $request->merge(['id_pengguna' => $pengguna->id_pengguna]);

            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'required|date',
                'nomor_telepon' => 'required|string|max:20',
                'email' => 'required|email',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // 10MB
                'detail_alamat' => 'nullable|string',
                'id_kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            ], [
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong!',
                'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong!',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
                'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Format email tidak valid!',
                'foto.image' => 'File harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpeg, png, atau jpg!',
                'foto.max' => 'Ukuran foto maksimal 10MB!',
                'id_kelurahan.required' => 'Kelurahan tidak boleh kosong!',
            ]);

            // Check if email is already used by other account
            $existingAccount = $this->AkunModel
                ->where('email', $request->input('email'))
                ->where('id_akun', '!=', $pengguna->id_akun)
                ->first();
                
            if ($existingAccount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan oleh akun lain!'
                ], 400);
            }

            // Update akun data
            $akunData = [
                'email' => $request->input('email')
            ];

            $this->AkunModel->where('id_akun', $pengguna->id_akun)->update($akunData);

            // Handle file upload
            $fotoPath = $pengguna->foto; // Keep existing photo by default
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($pengguna->foto && Storage::disk('public')->exists($pengguna->foto)) {
                    Storage::disk('public')->delete($pengguna->foto);
                }
                $fotoPath = $request->file('foto')->store('pengguna', 'public');
            }

            // Update pengguna data
            $penggunaData = [
                'nama_lengkap' => $request->input('nama_lengkap'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'foto' => $fotoPath,
                'detail_alamat' => $request->input('detail_alamat'),
                'id_kelurahan' => $request->input('id_kelurahan'),
            ];

            $updatePengguna = $this->PenggunaModel
                ->where('id_pengguna', $pengguna->id_pengguna)
                ->update($penggunaData);

            if ($updatePengguna) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profil berhasil diperbarui!'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan data!'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            \Log::error('Update profile error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui profil: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk mendapatkan kelurahan berdasarkan kecamatan (untuk AJAX)
    public function getKelurahanByKecamatan($kecamatanId)
    {
        try {
            $kelurahan = $this->KelurahanModel
                ->where('id_kecamatan', $kecamatanId)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $kelurahan
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kelurahan!'
            ], 500);
        }
    }
}