<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use App\Models\BarangModel;
use App\Models\PenukaranBarangModel;
use App\Models\PenggunaModel; 
use App\Models\AkunModel;
use App\Models\DonasiModel;
use App\Models\PenukaranDonasiModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;

class TukarPoinController extends Controller
{
    protected $PenggunaModel;
    protected $KelurahanModel;
    protected $KecamatanModel;

    public function __construct()
    {
        $this->PenggunaModel = new PenggunaModel;
        $this->KelurahanModel = new KelurahanModel;
        $this->KecamatanModel = new KecamatanModel;
    }

    /**
     * Menampilkan halaman tukar poin
     */
    public function index()
    {
        try {
            // Debug: Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('User not authenticated, redirecting to login');
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
            }

            // Get authenticated user
            $user = Auth::user();
            
            // Debug: Log user data
            Log::info('Authenticated user:', [
                'id_akun' => $user->id_akun ?? null,
                'email' => $user->email ?? null,
                'id_level' => $user->id_level ?? null
            ]);
            
            // Check if user has isPengguna method before calling it
            if (method_exists($user, 'isPengguna') && !$user->isPengguna()) {
                Log::warning('User is not pengguna level', ['id_level' => $user->id_level ?? null]);
                return redirect()->back()->with('error', 'Akses ditolak! Anda bukan pengguna.');
            }
            
            // Find pengguna by akun ID
            $pengguna = $this->PenggunaModel->with(['akun', 'kelurahan.kecamatan'])
                ->where('id_akun', $user->id_akun)
                ->first();

            // If pengguna not found, try alternative approach
            if (!$pengguna) {
                Log::info('Pengguna not found by id_akun, trying alternative approach');
                
                // Maybe the relationship is different, try finding by email
                $pengguna = $this->PenggunaModel->with(['akun', 'kelurahan.kecamatan'])
                    ->whereHas('akun', function($query) use ($user) {
                        $query->where('email', $user->email);
                    })
                    ->first();
            }

            if (!$pengguna) {
                Log::error('Pengguna not found for user:', [
                    'user_id' => $user->id_akun ?? $user->id, 
                    'email' => $user->email
                ]);
                
                return redirect()->back()->with('error', 'Profil pengguna tidak ditemukan! Silakan hubungi administrator.');
            }

            // Ambil semua barang yang tersedia untuk ditukar
            $barangs = BarangModel::where('stok', '>', 0)->get();

            // Ambil semua donasi yang tersedia
            $donasis = DonasiModel::all(); // Changed from get() to all()

            // Debug: Log retrieved data
            Log::info('Tukar poin data loaded:', [
                'pengguna_id' => $pengguna->id_pengguna,
                'nama' => $pengguna->nama_lengkap,
                'total_poin' => $pengguna->total_poin,
                'barang_count' => $barangs->count(),
                'donasi_count' => $donasis->count()
            ]);
            
            return view('tukar-poin.tukar-poin', compact('pengguna', 'barangs', 'donasis'));
            
        } catch (Exception $e) {
            Log::error('Error in TukarPoinController@index: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat memuat halaman: ' . $e->getMessage());
        }
    }

    /**
     * Tukar poin dengan barang
     */
    public function tukarBarang(Request $request)
    {
        // Check if request is AJAX
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak valid'
            ], 400);
        }

        try {
            $validator = Validator::make($request->all(), [
                'id_barang' => 'required|exists:barang,id_barang',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get authenticated user
            $user = Auth::user();
            
            // Double check authentication
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi telah berakhir, silakan login kembali',
                    'redirect' => route('login')
                ], 401);
            }

            // Find pengguna by akun ID
            $pengguna = $this->PenggunaModel->where('id_akun', $user->id_akun)->first();

            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pengguna tidak ditemukan'
                ], 404);
            }

            $barang = BarangModel::find($request->id_barang);

            if (!$barang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Barang tidak ditemukan'
                ], 404);
            }

            // Use database transaction for consistency
            DB::beginTransaction();

            try {
                // Refresh user data to get latest points
                $pengguna->refresh();

                // Cek apakah poin pengguna cukup
                if ($pengguna->total_poin < $barang->bobot_poin) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Poin Anda tidak mencukupi untuk menukar barang ini'
                    ], 400);
                }

                // Refresh barang data to get latest stock
                $barang->refresh();

                // Cek apakah stok barang masih tersedia
                if ($barang->stok <= 0) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok barang tidak tersedia'
                    ], 400);
                }

                // Generate ID dan kode redeem unik - FIXED SYNTAX ERROR
                $idPenukaranBarang = 'B' . date('Ymdhi') . $pengguna->id_pengguna;
                $kodeRedeem = 'RDM' . strtoupper(Str::random(7));

                // Debug: Log data yang akan disimpan
                Log::info('Creating PenukaranBarang with data:', [
                    'id_penukaran_barang' => $idPenukaranBarang,
                    'waktu' => now(),
                    'jumlah_poin' => $barang->bobot_poin,
                    'kode_redeem' => $kodeRedeem,
                    'id_barang' => $request->id_barang,
                    'id_pengguna' => $pengguna->id_pengguna,
                    'status_redeem' => false
                ]);

                // Buat transaksi penukaran barang
                $penukaranBarang = PenukaranBarangModel::create([
                    'id_penukaran_barang' => $idPenukaranBarang,
                    'waktu' => now(),
                    'jumlah_poin' => $barang->bobot_poin,
                    'kode_redeem' => $kodeRedeem,
                    'id_barang' => $request->id_barang,
                    'id_pengguna' => $pengguna->id_pengguna,
                    'status_redeem' => false
                ]);

                // Kurangi poin pengguna
                $pengguna->total_poin -= $barang->bobot_poin;
                $pengguna->save();

                // Kurangi stok barang
                $barang->stok -= 1;
                $barang->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menukar barang! Kode redeem: ' . $kodeRedeem,
                    'data' => [
                        'kode_redeem' => $kodeRedeem,
                        'nama_barang' => $barang->nama_barang,
                        'poin_digunakan' => $barang->bobot_poin,
                        'sisa_poin' => $pengguna->total_poin
                    ]
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                // Log error detail untuk debugging
                Log::error('Error in DB transaction: ' . $e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->all(),
                    'pengguna_id' => $pengguna->id_pengguna ?? 'unknown',
                    'barang_id' => $request->id_barang
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Error in TukarPoinController@tukarBarang: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            // Return more specific error message in development
            if (config('app.debug')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                    'debug' => [
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ]
                ], 500);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menukar barang'
            ], 500);
        }
    }

    /**
     * Tukar poin dengan donasi
     */
    public function tukarDonasi(Request $request)
    {
        // Check if request is AJAX
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak valid'
            ], 400);
        }

        try {
            // Enhanced validation with better error messages
            $validator = Validator::make($request->all(), [
                'id_donasi' => 'required|string|exists:donasi,id_donasi',
                'jumlah_poin' => 'required|integer|min:1|max:1000000'
            ], [
                'id_donasi.required' => 'ID donasi diperlukan',
                'id_donasi.exists' => 'Program donasi tidak ditemukan',
                'jumlah_poin.required' => 'Jumlah poin diperlukan',
                'jumlah_poin.integer' => 'Jumlah poin harus berupa angka',
                'jumlah_poin.min' => 'Jumlah poin minimal 1',
                'jumlah_poin.max' => 'Jumlah poin maksimal 1.000.000'
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed in tukarDonasi', [
                    'request_data' => $request->all(),
                    'errors' => $validator->errors()->toArray()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get authenticated user with better error handling
            $user = Auth::user();
            
            if (!$user) {
                Log::warning('User not authenticated in tukarDonasi');
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi telah berakhir, silakan login kembali',
                    'redirect' => route('login')
                ], 401);
            }

            Log::info('Processing donation exchange', [
                'user_id' => $user->id_akun,
                'id_donasi' => $request->id_donasi,
                'jumlah_poin' => $request->jumlah_poin
            ]);

            // Find pengguna with better error handling
            $pengguna = $this->PenggunaModel->where('id_akun', $user->id_akun)->first();

            if (!$pengguna) {
                Log::error('Pengguna not found in tukarDonasi', [
                    'user_id_akun' => $user->id_akun,
                    'user_email' => $user->email
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Data pengguna tidak ditemukan'
                ], 404);
            }

            // Find donasi with better error handling
            $donasi = DonasiModel::find($request->id_donasi);
            
            if (!$donasi) {
                Log::error('Donasi not found', ['id_donasi' => $request->id_donasi]);
                return response()->json([
                    'success' => false,
                    'message' => 'Program donasi tidak ditemukan'
                ], 404);
            }

            $jumlahPoin = (int) $request->jumlah_poin;

            Log::info('Pre-transaction data', [
                'pengguna_id' => $pengguna->id_pengguna,
                'current_poin' => $pengguna->total_poin,
                'requested_poin' => $jumlahPoin,
                'donasi_id' => $donasi->id_donasi,
                'donasi_name' => $donasi->nama_donasi
            ]);

            // Use database transaction for consistency
            DB::beginTransaction();

            try {
                // Refresh user data to get latest points
                $pengguna->refresh();

                // Cek apakah poin pengguna cukup
                if ($pengguna->total_poin < $jumlahPoin) {
                    DB::rollBack();
                    Log::warning('Insufficient points', [
                        'user_points' => $pengguna->total_poin,
                        'required_points' => $jumlahPoin
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Poin Anda tidak mencukupi untuk melakukan donasi'
                    ], 400);
                }

                // Generate ID unik untuk penukaran donasi with better uniqueness
                $timestamp = now()->format('YmdHi');
                $randomString = Str::upper(Str::random(6));
                $idPenukaranDonasi = 'D' . date('Ymdhi') . $id_pengguna = $pengguna->id_pengguna;
                // Ensure uniqueness of ID
                $attempts = 0;
                while (PenukaranDonasiModel::where('id_penukaran_donasi', $idPenukaranDonasi)->exists() && $attempts < 5) {
                    $randomString = Str::upper(Str::random(6));
                    $idPenukaranDonasi = 'D' . $timestamp . $randomString;
                    $attempts++;
                }

                if ($attempts >= 5) {
                    DB::rollBack();
                    Log::error('Failed to generate unique ID after 5 attempts');
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal membuat ID transaksi unik, silakan coba lagi'
                    ], 500);
                }

                Log::info('Creating donation transaction', [
                    'id_penukaran_donasi' => $idPenukaranDonasi,
                    'pengguna_id' => $pengguna->id_pengguna,
                    'donasi_id' => $request->id_donasi,
                    'jumlah_poin' => $jumlahPoin
                ]);

                // Buat transaksi penukaran donasi
                $penukaranDonasi = PenukaranDonasiModel::create([
                    'id_penukaran_donasi' => $idPenukaranDonasi,
                    'waktu' => now(),
                    'jumlah_poin' => $jumlahPoin,
                    'id_donasi' => $request->id_donasi,
                    'id_pengguna' => $pengguna->id_pengguna
                ]);

                if (!$penukaranDonasi) {
                    DB::rollBack();
                    Log::error('Failed to create PenukaranDonasiModel record');
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menyimpan data donasi'
                    ], 500);
                }

                // Kurangi poin pengguna
                $oldPoin = $pengguna->total_poin;
                $pengguna->total_poin -= $jumlahPoin;
                
                if (!$pengguna->save()) {
                    DB::rollBack();
                    Log::error('Failed to update pengguna points');
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengupdate poin pengguna'
                    ], 500);
                }

                Log::info('Points updated successfully', [
                    'old_points' => $oldPoin,
                    'new_points' => $pengguna->total_poin,
                    'deducted' => $jumlahPoin
                ]);

                DB::commit();

                Log::info('Donation transaction completed successfully', [
                    'transaction_id' => $idPenukaranDonasi,
                    'pengguna_id' => $pengguna->id_pengguna,
                    'points_used' => $jumlahPoin,
                    'remaining_points' => $pengguna->total_poin
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil melakukan donasi!',
                    'data' => [
                        'nama_donasi' => $donasi->nama_donasi,
                        'poin_digunakan' => $jumlahPoin,
                        'sisa_poin' => $pengguna->total_poin,
                        'transaction_id' => $idPenukaranDonasi
                    ]
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Database transaction failed in tukarDonasi', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->all()
                ]);
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Error in TukarPoinController@tukarDonasi', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat melakukan donasi: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getValidIdPengguna()
    {
        $currentUserId = Auth::id(); // ID dari tabel akun (users)

        if (!$currentUserId) {
            throw new \Exception('Anda belum login. Silakan login terlebih dahulu.');
        }

        // Cari pengguna berdasarkan foreign key id_akun yang berelasi dengan id dari tabel akun
        $pengguna = PenggunaModel::where('id_akun', $currentUserId)->first();

        if (!$pengguna) {
            // Debug information untuk membantu troubleshooting
            \Log::error('Pengguna tidak ditemukan', [
                'current_user_id' => $currentUserId,
                'auth_user' => Auth::user()
            ]);
            
            throw new \Exception('Data pengguna tidak ditemukan. Silakan hubungi administrator untuk melengkapi profil Anda.');
        }

        return $pengguna->id_pengguna; // Return primary key dari tabel pengguna
    }

    /**
     * Menampilkan riwayat tukar poin pengguna
     */
    public function riwayatTukarPoin()
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();

            // Bisa ditambahkan select() untuk optimasi jika tidak semua kolom diperlukan
            $riwayatTukarDonasi = PenukaranDonasiModel::with(['donasi', 'pengguna'])
                ->where('id_pengguna', $idPenggunaValid)
                ->orderBy('waktu', 'desc')
                ->get();

            $riwayatTukarBarang = PenukaranBarangModel::with(['barang', 'pengguna'])
                ->where('id_pengguna', $idPenggunaValid)
                ->orderBy('waktu', 'desc')
                ->get();

            // Bisa menggunakan find() jika lebih efisien
            $totalPoin = PenggunaModel::where('id_pengguna', $idPenggunaValid)->value('total_poin');

            return view('riwayat.riwayat-tukar-poin', compact('riwayatTukarBarang','riwayatTukarDonasi', 'totalPoin'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat riwayat tukar poin: ' . $e->getMessage());
        }
    }
    /**
     * Cek status redeem barang
     */
    public function cekStatusRedeem(Request $request)
    {
        // Check if request is AJAX
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak valid'
            ], 400);
        }

        try {
            $validator = Validator::make($request->all(), [
                'kode_redeem' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode redeem diperlukan'
                ], 422);
            }

            // Get authenticated user
            $user = Auth::user();
            
            // Double check authentication
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi telah berakhir, silakan login kembali',
                    'redirect' => route('login')
                ], 401);
            }

            // Find pengguna by akun ID
            $pengguna = $this->PenggunaModel->where('id_akun', $user->id_akun)->first();

            if (!$pengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pengguna tidak ditemukan'
                ], 404);
            }

            $penukaranBarang = PenukaranBarangModel::with('barang')
                ->where('kode_redeem', $request->kode_redeem)
                ->where('id_pengguna', $pengguna->id_pengguna)
                ->first();

            if (!$penukaranBarang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode redeem tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'kode_redeem' => $penukaranBarang->kode_redeem,
                    'nama_barang' => $penukaranBarang->barang->nama_barang,
                    'status' => ucfirst($penukaranBarang->status_redeem),
                    'waktu_penukaran' => $penukaranBarang->waktu,
                    'poin_digunakan' => $penukaranBarang->jumlah_poin
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error in TukarPoinController@cekStatusRedeem: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengecek status redeem'
            ], 500);
        }
    }
}