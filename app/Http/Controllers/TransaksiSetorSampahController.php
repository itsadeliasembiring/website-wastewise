<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiSetorSampah;
use App\Http\Requests\TransaksiSetorSampahRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SetorSampahModel;
use App\Models\DetailSetorSampahModel;
use App\Models\SampahModel;
use App\Models\PenggunaModel;
use App\Models\BankSampahModel;
use App\Models\PenukaranBarangModel;
use App\Models\PenukaranDonasiModel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransaksiSetorSampahController extends Controller
{
    protected $setorSampahModel;
    protected $detailSetorSampahModel;
    protected $sampahModel;
    protected $bankSampahModel;
    protected $penggunaModel;
    protected $penukaranBarangModel;
    protected $penukaranDonasiModel;

    
    public function __construct()
    {
        $this->setorSampahModel = new SetorSampahModel;
        $this->detailSetorSampahModel = new DetailSetorSampahModel;
        $this->sampahModel = new SampahModel;
        $this->bankSampahModel = new BankSampahModel;
        $this->penggunaModel = new PenggunaModel;
        $this->penukaranBarangModel = new PenukaranBarangModel;
        $this->penukaranDonasiModel = new PenukaranDonasiModel;
    }

    public function index()
    {
        try {
            // Ambil data jenis sampah untuk ditampilkan di form
            $jenisSampah = SampahModel::all();
            
            // DEBUG: Panggil debugging dulu
            $this->debugUserData();
            
            // Ambil statistik pengguna yang sedang login
            $userStats = $this->getUserStats();
            return view('setor-sampah.setor-sampah', compact('jenisSampah', 'userStats'));
            
        } catch (\Exception $e) {
            \Log::error('Error in index: ' . $e->getMessage());
            // Jika terjadi error saat mengambil stats, tetap tampilkan halaman dengan stats kosong
            $jenisSampah = SampahModel::all();
            $userStats = [
                'total_berat' => 0,
                'total_poin' => 0,
                'total_transaksi' => 0
            ];
           
            return view('setor-sampah.setor-sampah', compact('jenisSampah', 'userStats'))
                ->with('warning', 'Tidak dapat memuat statistik pengguna. Silakan coba lagi nanti.');
        }
    }

    private function getUserStats()
    {
        try {
            // Dapatkan ID pengguna yang valid
            $idPenggunaValid = $this->getValidIdPengguna();
            
            // Debug: Log ID pengguna
            \Log::info('Getting stats for user ID: ' . $idPenggunaValid);
            
            // Cek total record untuk user ini (tanpa filter status dulu)
            $totalRecords = SetorSampahModel::where('id_pengguna', $idPenggunaValid)->count();
            \Log::info('Total records for user: ' . $totalRecords);
            
            // Cek data dengan berbagai status
            $recordsByStatus = SetorSampahModel::where('id_pengguna', $idPenggunaValid)
                ->selectRaw('status_setor, COUNT(*) as count')
                ->groupBy('status_setor')
                ->get();
            \Log::info('Records by status: ' . $recordsByStatus->toJson());
            
            // Hitung total dengan menggunakan query yang lebih eksplisit
            $stats = DB::table('setor_sampah')
                ->where('id_pengguna', $idPenggunaValid)
                ->whereIn('status_setor', ['Selesai', 'terverifikasi', 'selesai', 'Terverifikasi', 'SELESAI', 'TERVERIFIKASI']) // Tambah variasi case
                ->selectRaw('
                    SUM(COALESCE(total_berat, 0)) as total_berat,
                    SUM(COALESCE(total_poin, 0)) as total_poin,
                    COUNT(*) as total_transaksi
                ')
                ->first();
                
            // Debug: Log hasil query
            \Log::info('Stats query result: ' . json_encode($stats));
            
            // Jika masih 0, coba tanpa filter status
            if (($stats->total_berat ?? 0) == 0) {
                $statsNoFilter = DB::table('setor_sampah')
                    ->where('id_pengguna', $idPenggunaValid)
                    ->selectRaw('
                        SUM(COALESCE(total_berat, 0)) as total_berat,
                        SUM(COALESCE(total_poin, 0)) as total_poin,
                        COUNT(*) as total_transaksi
                    ')
                    ->first();
                \Log::info('Stats without status filter: ' . json_encode($statsNoFilter));
            }
            
            return [
                'total_berat' => round($stats->total_berat ?? 0, 2),
                'total_poin' => round($stats->total_poin ?? 0, 0),
                'total_transaksi' => $stats->total_transaksi ?? 0,
                'berat_bulan_ini' => $this->getBeratBulanIni($idPenggunaValid),
                'poin_bulan_ini' => $this->getPoinBulanIni($idPenggunaValid)
            ];
            
        } catch (\Exception $e) {
            \Log::error('Error getting user stats: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Method untuk mendapatkan total berat sampah bulan ini - FIXED VERSION
     */
    private function getBeratBulanIni($idPengguna)
    {
        try {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            \Log::info("Getting berat bulan ini for month: $currentMonth, year: $currentYear");
            
            $beratBulanIni = DB::table('setor_sampah')
                ->where('id_pengguna', $idPengguna)
                ->whereIn('status_setor', ['Selesai', 'terverifikasi', 'selesai', 'Terverifikasi'])
                ->whereRaw('MONTH(waktu_setor) = ?', [$currentMonth])
                ->whereRaw('YEAR(waktu_setor) = ?', [$currentYear])
                ->sum('total_berat');
                
            \Log::info("Berat bulan ini result: " . $beratBulanIni);
                
            return round($beratBulanIni ?? 0, 2);
            
        } catch (\Exception $e) {
            \Log::error('Error getting berat bulan ini: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Method untuk mendapatkan total poin bulan ini - FIXED VERSION
     */
    private function getPoinBulanIni($idPengguna)
    {
        try {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            $poinBulanIni = DB::table('setor_sampah')
                ->where('id_pengguna', $idPengguna)
                ->whereIn('status_setor', ['Selesai', 'terverifikasi', 'selesai', 'Terverifikasi'])
                ->whereRaw('MONTH(waktu_setor) = ?', [$currentMonth])
                ->whereRaw('YEAR(waktu_setor) = ?', [$currentYear])
                ->sum('total_poin');
                
            return round($poinBulanIni ?? 0, 0);
            
        } catch (\Exception $e) {
            \Log::error('Error getting poin bulan ini: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Method untuk debugging - panggil ini untuk cek data
     */
    private function debugUserData()
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            // Cek semua data user
            $allUserData = DB::table('setor_sampah')
                ->where('id_pengguna', $idPenggunaValid)
                ->select('id_setor', 'waktu_setor', 'total_berat', 'total_poin', 'status_setor')
                ->get();
                
            \Log::info('All user data: ' . $allUserData->toJson());
            
            // Cek apakah kolom total_berat dan total_poin ada isi
            $nonZeroData = DB::table('setor_sampah')
                ->where('id_pengguna', $idPenggunaValid)
                ->where(function($query) {
                    $query->where('total_berat', '>', 0)
                        ->orWhere('total_poin', '>', 0);
                })
                ->count();
                
            \Log::info('Records with non-zero totals: ' . $nonZeroData);
            
            return $allUserData;
            
        } catch (\Exception $e) {
            \Log::error('Debug error: ' . $e->getMessage());
            return collect();
        }
    }
    /**
     * Menampilkan halaman setor langsung
     */
    public function setorLangsung()
    {
        // Ambil data jenis sampah untuk ditampilkan di form
        $jenisSampah = SampahModel::all();
        
        return view('setor-sampah.setor-langsung', compact('jenisSampah'));
    }

    /**
     * Proses penyetoran sampah langsung - DIPERBAIKI
     */
    public function prosesSetorLangsung(Request $request)
    {
        // Validasi input
        $request->validate([
            'sampah' => 'required|array',
            'sampah.*.id_sampah' => 'required|exists:sampah,id_sampah',
            'sampah.*.berat_kg' => 'required|numeric|min:0.1',
            'catatan' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        
        try {
            // Dapatkan ID pengguna yang valid berdasarkan relasi
            $idPenggunaValid = $this->getValidIdPengguna();
            
            // Generate ID setor yang unik
            $lastId = $this->setorSampahModel->orderBy('id_setor', 'desc')->first();
            $newId = 'ST001';
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_setor, 2));
                $newIdNum = $lastIdNum + 1;
                $newId = 'ST' . Str::padLeft($newIdNum, 3, '0');
            }

            $kodeVerifikasi = strtoupper(substr(md5(uniqid((string)rand(), true)), 0, 8));

            // Buat record setor sampah utama
            $setorSampah = SetorSampahModel::create([
                'id_setor' => $newId,
                'waktu_setor' => Carbon::now(),
                'total_berat' => 0,
                'total_poin' => 0,
                'lokasi_penjemputan' => null,
                'waktu_penjemputan' => null,
                'kode_verifikasi' => $kodeVerifikasi,
                'status_verifikasi' => false,
                'status_setor' => 'pending',
                'metode_setor' => 'Setor Langsung',
                'catatan' => $request->catatan,
                'id_bank_sampah' => 'B01',
                'id_pengguna' => $idPenggunaValid,
            ]);

            // Simpan detail setor untuk setiap jenis sampah
            $detailIndex = 1;
            foreach ($request->sampah as $sampahData) {
                if ($sampahData['berat_kg'] > 0) {
                    DetailSetorSampahModel::create([
                        'id_detail' => $this->generateIdDetail($newId, $detailIndex),
                        'berat_kg' => $sampahData['berat_kg'],
                        'id_setor' => $newId,
                        'id_sampah' => $sampahData['id_sampah'],
                    ]);
                    $detailIndex++;
                }
            }

            // Update total berat dan poin (akan dilakukan otomatis oleh event model)
            $setorSampah->refresh();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sampah berhasil disetor!',
                'data' => [
                    'id_setor' => $newId,
                    'kode_verifikasi' => $setorSampah->kode_verifikasi,
                    'total_berat' => $setorSampah->calculated_total_berat ?? $setorSampah->total_berat,
                    'total_poin' => $setorSampah->calculated_total_poin ?? $setorSampah->total_poin,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyetor sampah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * SOLUSI UTAMA: Method untuk mendapatkan ID pengguna yang valid dari relasi tabel
     */
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
     * Method untuk mendapatkan data lengkap pengguna yang login
     */
    private function getCurrentUserData()
    {
        $currentUserId = Auth::id();

        if (!$currentUserId) {
            throw new \Exception('Anda belum login. Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna lengkap berdasarkan relasi
        $pengguna = PenggunaModel::where('id_akun', $currentUserId)->first();

        if (!$pengguna) {
            throw new \Exception('Data pengguna tidak ditemukan. Silakan hubungi administrator untuk melengkapi profil Anda.');
        }

        return $pengguna;
    }

    public function riwayatSetorSampah()
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            // Get user's total points
            $totalPoin = PenggunaModel::where('id_pengguna', $idPenggunaValid)->value('total_poin');
    
            // Get transaction history with related data
            $riwayatSetor = SetorSampahModel::with(['detailSetorSampah.sampah', 'bankSampah'])
                ->where('id_pengguna', $idPenggunaValid)
                ->orderBy('waktu_setor', 'desc')
                ->get();

            // Format data for the view
            $riwayatSetor = $riwayatSetor->map(function ($setor) {
                // Format status display
                $statusDisplay = $this->getStatusDisplay($setor->status_setor);
                // dd($statusDisplay);
                // Format service type
                $layananDisplay = $setor->metode_setor === 'jemput' ? 'Jemput' : 'Langsung';
                
                // Format date and time
                $waktuSetor = \Carbon\Carbon::parse($setor->waktu_setor);
                
                // Get waste types details
                $wasteTypes = $setor->detailSetorSampah->map(function ($detail) {
                    return [
                        'name' => $detail->sampah->nama_sampah ?? 'Unknown',
                        'weight' => $detail->berat_kg,
                        'unit' => 'Kg'
                    ];
                });

                return [
                    'id_setor' => $setor->id_setor,
                    'bank_sampah_nama' => $setor->bankSampah->nama_bank_sampah ?? 'Bank Sampah',
                    'tanggal' => $waktuSetor->format('d F Y'),
                    'jam' => $waktuSetor->format('H:i') . ' WIB',
                    'total_berat' => $setor->total_berat ?? $setor->calculated_total_berat,
                    'layanan' => $layananDisplay,
                    'status' => $setor->status_setor,
                    'status_display' => $statusDisplay,
                    'total_poin' => $setor->total_poin ?? $setor->calculated_total_poin,
                    'alamat' => $setor->lokasi_penjemputan ?? $setor->bankSampah->alamat ?? '',
                    'catatan' => $setor->catatan ?? 'Tidak ada catatan',
                    'kode_verifikasi' => $setor->kode_verifikasi,
                    'waste_types' => $wasteTypes,
                    'alasan_pembatalan' => $setor->alasan_pembatalan ?? null,
                    'waktu_penjemputan' => $setor->waktu_penjemputan ? \Carbon\Carbon::parse($setor->waktu_penjemputan)->format('d F Y H:i') . ' WIB' : null
                ];
            });

            return view('riwayat.riwayat-setor-sampah', compact('riwayatSetor', 'totalPoin'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat riwayat setoran: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail setoran
     */
    public function detailSetorSampah($idSetor)
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $setorSampah = SetorSampahModel::with(['detailSetorSampah.sampah', 'bankSampah'])
                ->where('id_setor', $idSetor)
                ->where('id_pengguna', $idPenggunaValid)
                ->firstOrFail();

            // Format data for JSON response
            $waktuSetor = \Carbon\Carbon::parse($setorSampah->waktu_setor);
            
            $detailData = [
                'id' => $setorSampah->id_setor,
                'title' => $setorSampah->bankSampah->nama_bank_sampah ?? 'Bank Sampah',
                'date' => $waktuSetor->format('d F Y'),
                'time' => $waktuSetor->format('H:i') . ' WIB',
                'service' => $setorSampah->metode_setor === 'jemput' ? 'Jemput' : 'Langsung',
                'status' => $this->getStatusDisplay($setorSampah->status_setor),
                'points' => $setorSampah->total_poin ?? $setorSampah->calculated_total_poin,
                'waste_types' => $setorSampah->detailSetorSampah->map(function ($detail) {
                    return [
                        'name' => $detail->sampah->nama_sampah ?? 'Unknown',
                        'weight' => $detail->berat_kg,
                        'unit' => 'Kg'
                    ];
                }),
                'total_weight' => $setorSampah->total_berat ?? $setorSampah->calculated_total_berat,
                'address' => $setorSampah->lokasi_penjemputan ?? $setorSampah->bankSampah->alamat ?? '',
                'notes' => $setorSampah->catatan ?? 'Tidak ada catatan',
                'cancellation_reason' => $setorSampah->alasan_pembatalan ?? null
            ];

            return response()->json($detailData);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Detail setoran tidak ditemukan'], 404);
        }
    }

    /**
     * Show verification code for pickup service
     */
    public function showKodeVerifikasi($idSetor)
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $setorSampah = SetorSampahModel::where('id_setor', $idSetor)
                ->where('id_pengguna', $idPenggunaValid)
                ->where('metode_setor', 'jemput')
                ->whereIn('status_setor', ['diproses', 'selesai'])
                ->firstOrFail();

            return response()->json([
                'kode_verifikasi' => $setorSampah->kode_verifikasi,
                'status' => $setorSampah->status_setor,
                'bank_sampah' => $setorSampah->bankSampah->nama_bank_sampah ?? 'Bank Sampah'
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Kode verifikasi tidak ditemukan'], 404);
        }
    }

    /**
     * Get status display text and color
     */
    private function getStatusDisplay($status)
    {
        $statusMap = [
            'menunggu konfirmasi' => [
                'text' => 'Menunggu Konfirmasi',
                'color_class' => 'text-grey-600',
            ],
            'diproses' => [
                'text' => 'Di Proses',
                'color_class' => 'text-yellow-500'
            ],
            'selesai' => [
                'text' => 'Selesai',
                'color_class' => 'text-green-600'
            ],
            'dibatalkan' => [
                'text' => 'Dibatalkan',
                'color_class' => 'text-red-500'
            ],
        ];

        return $statusMap[$status] ?? [
            'text' => ucfirst($status),
            'color_class' => 'text-gray-600',
        ];
    }
    /**
     * Batalkan setoran (hanya jika status masih pending)
     */
    public function batalkanSetor($idSetor)
    {
        DB::beginTransaction();
        
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $setorSampah = SetorSampahModel::where('id_setor', $idSetor)
                ->where('id_pengguna', $idPenggunaValid)
                ->where('status_setor', 'menunggu konfirmasi')
                ->firstOrFail();

            // Update status menjadi dibatalkan
            $setorSampah->update([
                'status_setor' => 'dibatalkan',
                'catatan' => ($setorSampah->catatan ? $setorSampah->catatan . ' | ' : '') . 'Dibatalkan oleh pengguna pada ' . Carbon::now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Setoran berhasil dibatalkan'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membatalkan setoran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate ID detail yang unik - DIPERBAIKI SEPENUHNYA
     */
    private function generateIdDetail($idSetor, $index)
    {
        // Format: ID_SETOR + nomor urut 2 digit
        // Contoh: ST001 + 01 = ST00101
        return $idSetor . str_pad($index, 2, '0', STR_PAD_LEFT);
    }

    /**
     * API endpoint untuk mendapatkan data jenis sampah
     */
    public function getJenisSampah()
    {
        $jenisSampah = SampahModel::select('id_sampah', 'nama_sampah', 'bobot_poin')
            ->orderBy('nama_sampah')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $jenisSampah
        ]);
    }

    /**
     * Cek status setoran
     */
    public function cekStatusSetor($idSetor)
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $setorSampah = SetorSampahModel::with(['detailSetorSampah.sampah'])
                ->where('id_setor', $idSetor)
                ->where('id_pengguna', $idPenggunaValid)
                ->first();

            if (!$setorSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data setoran tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id_setor' => $setorSampah->id_setor,
                    'status_setor' => $setorSampah->status_setor,
                    'status_verifikasi' => $setorSampah->status_verifikasi,
                    'waktu_setor' => $setorSampah->waktu_setor,
                    'total_berat' => $setorSampah->calculated_total_berat ?? $setorSampah->total_berat,
                    'total_poin' => $setorSampah->calculated_total_poin ?? $setorSampah->total_poin,
                    'kode_verifikasi' => $setorSampah->kode_verifikasi,
                    'detail_sampah' => $setorSampah->detailSetorSampah->map(function($detail) {
                        return [
                            'nama_sampah' => $detail->sampah->nama_sampah,
                            'berat_kg' => $detail->berat_kg,
                            'poin' => $detail->berat_kg * $detail->sampah->bobot_poin
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Method tambahan untuk debug - bisa dihapus setelah testing
     */
    public function debugUserInfo()
    {
        try {
            $currentUserId = Auth::id();
            $currentUser = Auth::user();
            $pengguna = PenggunaModel::where('id_akun', $currentUserId)->first();
            
            return response()->json([
                'current_user_id' => $currentUserId,
                'current_user' => $currentUser,
                'pengguna_record' => $pengguna,
                'all_pengguna' => PenggunaModel::select('id_pengguna', 'id_akun', 'nama_pengguna')->get()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Menampilkan halaman jemput sampah dengan data pengguna lengkap - UPDATED
     */
    public function jemputSampah()
    {
        try {
            // Ambil data jenis sampah untuk ditampilkan di form
            $jenisSampah = SampahModel::all();
            
            // Ambil data lengkap pengguna yang login dengan JOIN ke tabel kelurahan dan kecamatan
            $userId = $this->getCurrentUserData()->id_pengguna;
            
            $penggunaData = DB::table('pengguna')
                ->leftJoin('kelurahan', 'pengguna.id_kelurahan', '=', 'kelurahan.id_kelurahan')
                ->leftJoin('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id_kecamatan')
                ->select(
                    'pengguna.*',
                    'kelurahan.nama_kelurahan',
                    'kecamatan.nama_kecamatan'
                )
                ->where('pengguna.id_pengguna', $userId)
                ->first();

            $kecamatanData = DB::table('kecamatan')
                            ->select('id_kecamatan', 'nama_kecamatan')
                            ->get();

            return view('setor-sampah.jemput-sampah', compact('jenisSampah', 'penggunaData', 'kecamatanData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat halaman jemput sampah: ' . $e->getMessage());
        }
    }

    public function getKelurahanByKecamatan($kecamatanId)
    {
        try {
            $kelurahan = DB::table('kelurahan')
                ->where('id_kecamatan', $kecamatanId)
                ->select('id_kelurahan', 'nama_kelurahan')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $kelurahan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kelurahan!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Proses penjemputan sampah - FIXED: Perbaikan validasi alamat utama
     */
    public function prosesJemputSampah(Request $request)
    {
        // Validasi input - UPDATED: kecamatan dan kelurahan custom diperlukan hanya jika alamat custom
        $request->validate([
            'sampah' => 'required|array',
            'sampah.*.id_sampah' => 'required|exists:sampah,id_sampah',
            'sampah.*.berat_kg' => 'required|numeric|min:0.1',
            'alamat_type' => 'required|in:main,custom',
            'alamat_custom' => 'required_if:alamat_type,custom|nullable|string|max:500',
            'kelurahan_custom' => 'required_if:alamat_type,custom|nullable|exists:kelurahan,id_kelurahan',
            'kecamatan_custom' => 'required_if:alamat_type,custom|nullable|exists:kecamatan,id_kecamatan',
            'waktu_penjemputan' => 'required|date|after:now',
            'catatan' => 'nullable|string|max:500',
            'catatan_alamat' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        
        try {
            // Dapatkan data lengkap pengguna yang login
            $penggunaData = $this->getCurrentUserDataWithAddress();
            
            // Generate ID setor yang unik untuk jemput sampah
            $lastId = $this->setorSampahModel->orderBy('id_setor', 'desc')->first();
            $newId = 'JP001'; // JP untuk Jemput Sampah
            if ($lastId) {
                // Ambil semua record dengan prefix JP
                $lastJemputId = $this->setorSampahModel
                    ->where('id_setor', 'LIKE', 'JP%')
                    ->orderBy('id_setor', 'desc')
                    ->first();
                
                if ($lastJemputId) {
                    $lastIdNum = intval(substr($lastJemputId->id_setor, 2));
                    $newIdNum = $lastIdNum + 1;
                    $newId = 'JP' . Str::padLeft($newIdNum, 3, '0');
                }
            }

            $kodeVerifikasi = strtoupper(substr(md5(uniqid((string)rand(), true)), 0, 8));

            // Parse waktu penjemputan
            $waktuPenjemputan = Carbon::parse($request->waktu_penjemputan);

            // Tentukan alamat penjemputan berdasarkan pilihan user - FIXED
            $alamatPenjemputan = $this->buildAlamatPenjemputan($request, $penggunaData);

            // Buat record setor sampah utama untuk jemput sampah
            $setorSampah = SetorSampahModel::create([
                'id_setor' => $newId,
                'waktu_setor' => Carbon::now(),
                'total_berat' => 0,
                'total_poin' => 0,
                'lokasi_penjemputan' => $alamatPenjemputan['alamat_lengkap'],
                'waktu_penjemputan' => $waktuPenjemputan,
                'kode_verifikasi' => $kodeVerifikasi,
                'status_verifikasi' => false,
                'status_setor' => 'dijadwalkan', // Status khusus untuk jemput sampah
                'metode_setor' => 'Jemput Sampah',
                'catatan' => $this->gabungkanCatatan($request->catatan, $request->catatan_alamat, $alamatPenjemputan['catatan_tambahan']),
                'id_bank_sampah' => 'B01',
                'id_pengguna' => $penggunaData->id_pengguna,
            ]);

            // Simpan detail setor untuk setiap jenis sampah
            $detailIndex = 1;
            foreach ($request->sampah as $sampahData) {
                if ($sampahData['berat_kg'] > 0) {
                    DetailSetorSampahModel::create([
                        'id_detail' => $this->generateIdDetail($newId, $detailIndex),
                        'berat_kg' => $sampahData['berat_kg'],
                        'id_setor' => $newId,
                        'id_sampah' => $sampahData['id_sampah'],
                    ]);
                    $detailIndex++;
                }
            }

            // Update total berat dan poin (akan dilakukan otomatis oleh event model)
            $setorSampah->refresh();

            DB::commit();
            Carbon::setLocale('id'); // Set bahasa Indonesia
            $waktuPenjemputan = Carbon::parse($waktuPenjemputan);
            return response()->json([
                'success' => true,
                'message' => 'Permintaan jemput sampah berhasil diajukan!',
                'data' => [
                    'id_penjemputan' => $newId,
                    'kode_verifikasi' => $setorSampah->kode_verifikasi,
                    'total_berat' => $setorSampah->calculated_total_berat ?? $setorSampah->total_berat,
                    'total_poin' => $setorSampah->calculated_total_poin ?? $setorSampah->total_poin,
                    'waktu_penjemputan_formatted' => $waktuPenjemputan->translatedFormat('l, d F Y H:i'),
                    'alamat_penjemputan' => $alamatPenjemputan['alamat_display']
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengajukan jemput sampah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * NEW: Method khusus untuk mendapatkan data pengguna dengan alamat lengkap
     */
    private function getCurrentUserDataWithAddress()
    {
        $currentUserId = Auth::id();

        if (!$currentUserId) {
            throw new \Exception('Anda belum login. Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna lengkap dengan JOIN ke tabel kelurahan dan kecamatan
        $pengguna = DB::table('pengguna')
            ->leftJoin('kelurahan', 'pengguna.id_kelurahan', '=', 'kelurahan.id_kelurahan')
            ->leftJoin('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id_kecamatan')
            ->select(
                'pengguna.*',
                'kelurahan.nama_kelurahan',
                'kecamatan.nama_kecamatan'
            )
            ->where('pengguna.id_akun', $currentUserId)
            ->first();

        if (!$pengguna) {
            throw new \Exception('Data pengguna tidak ditemukan. Silakan hubungi administrator untuk melengkapi profil Anda.');
        }

        return $pengguna;
    }

    /**
     * Method untuk membangun alamat penjemputan berdasarkan pilihan user - FIXED
     */
    private function buildAlamatPenjemputan($request, $penggunaData)
    {
        if ($request->alamat_type === 'main') {
            // Gunakan alamat utama pengguna - FIXED: gunakan field yang benar
            $alamatLengkap = trim($penggunaData->detail_alamat ?? '');
            $kelurahan = trim($penggunaData->nama_kelurahan ?? '');
            $kecamatan = trim($penggunaData->nama_kecamatan ?? '');
            
            // Validasi alamat utama - RELAXED: hanya perlu alamat detail
            if (empty($alamatLengkap)) {
                throw new \Exception('Alamat detail Anda belum diatur. Silakan lengkapi profil terlebih dahulu atau gunakan alamat lainnya.');
            }
            
            $alamatDisplay = $alamatLengkap;
            
            // Build alamat lengkap dengan data yang tersedia
            $alamatPenuh = $alamatLengkap;
            if (!empty($kelurahan)) {
                $alamatPenuh .= ", Kelurahan {$kelurahan}";
            }
            if (!empty($kecamatan)) {
                $alamatPenuh .= ", Kecamatan {$kecamatan}";
            }
            
            $catatanTambahan = "Menggunakan alamat utama pengguna";
            
        } else {
            // Gunakan alamat custom - FIXED: ambil nama kelurahan dan kecamatan dari database
            $alamatLengkap = trim($request->alamat_custom);
            
            // Ambil nama kelurahan dan kecamatan berdasarkan ID
            $kelurahanData = DB::table('kelurahan')
                ->join('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id_kecamatan')
                ->where('kelurahan.id_kelurahan', $request->kelurahan_custom)
                ->select('kelurahan.nama_kelurahan', 'kecamatan.nama_kecamatan')
                ->first();
            
            if (!$kelurahanData) {
                throw new \Exception('Data kelurahan tidak ditemukan.');
            }
            
            $kelurahan = $kelurahanData->nama_kelurahan;
            $kecamatan = $kelurahanData->nama_kecamatan;
            
            $alamatDisplay = $alamatLengkap;
            $alamatPenuh = "{$alamatLengkap}, Kelurahan {$kelurahan}, Kecamatan {$kecamatan}";
            $catatanTambahan = "Menggunakan alamat khusus untuk penjemputan ini";
        }
        
        return [
            'alamat_lengkap' => $alamatPenuh,
            'alamat_display' => $alamatDisplay,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'catatan_tambahan' => $catatanTambahan
        ];
    }

    /**
     * Method helper untuk menggabungkan catatan - UPDATED
     */
    private function gabungkanCatatan($catatan, $catatanAlamat, $catatanTambahan = null)
    {
        $gabunganCatatan = [];
        
        if (!empty($catatan)) {
            $gabunganCatatan[] = "Catatan Jemput: " . $catatan;
        }
        
        if (!empty($catatanAlamat)) {
            $gabunganCatatan[] = "Catatan Alamat: " . $catatanAlamat;
        }
        
        if (!empty($catatanTambahan)) {
            $gabunganCatatan[] = "Info: " . $catatanTambahan;
        }
        
        return implode(' | ', $gabunganCatatan);
    }

    /**
     * Mendapatkan daftar jadwal penjemputan yang tersedia
     */
    public function getJadwalTersedia(Request $request)
    {
        try {
            $tanggal = $request->get('tanggal');
            
            if (!$tanggal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal harus diisi'
                ], 400);
            }

            // Validasi tanggal minimal besok
            $tanggalPilihan = Carbon::parse($tanggal);
            $besok = Carbon::tomorrow();
            
            if ($tanggalPilihan->isBefore($besok)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal penjemputan minimal H+1'
                ], 400);
            }

            // Jam operasional 08:00 - 16:00
            $jamTersedia = [];
            for ($jam = 8; $jam <= 16; $jam++) {
                // Cek apakah jam ini sudah penuh (misalnya maksimal 10 penjemputan per jam)
                $jumlahPenjemputan = SetorSampahModel::where('metode_setor', 'Jemput Sampah')
                    ->where('status_setor', 'dijadwalkan')
                    ->whereDate('waktu_penjemputan', $tanggal)
                    ->whereTime('waktu_penjemputan', '>=', sprintf('%02d:00:00', $jam))
                    ->whereTime('waktu_penjemputan', '<', sprintf('%02d:00:00', $jam + 1))
                    ->count();

                if ($jumlahPenjemputan < 10) { // Maksimal 10 penjemputan per jam
                    $jamTersedia[] = [
                        'jam' => $jam,
                        'label' => sprintf('%02d:00', $jam),
                        'tersedia' => true,
                        'sisa_slot' => 10 - $jumlahPenjemputan
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'data' => $jamTersedia
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}