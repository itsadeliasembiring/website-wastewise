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
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransaksiSetorSampahController extends Controller
{
    protected $setorSampahModel;
    protected $detailSetorSampahModel;
    protected $sampahModel;
    protected $bankSampahModel;
    protected $penggunaModel;
    
    public function __construct()
    {
        $this->setorSampahModel = new SetorSampahModel;
        $this->detailSetorSampahModel = new DetailSetorSampahModel;
        $this->sampahModel = new SampahModel;
        $this->bankSampahModel = new BankSampahModel;
        $this->penggunaModel = new PenggunaModel;
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

    /**
     * Menampilkan riwayat setoran pengguna
     */
    public function riwayatSetor()
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $riwayatSetor = SetorSampahModel::with(['detailSetorSampah.sampah', 'bankSampah'])
                ->where('id_pengguna', $idPenggunaValid)
                ->orderBy('waktu_setor', 'desc')
                ->paginate(10);

            return view('user.riwayat-setor', compact('riwayatSetor'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat riwayat setoran: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail setoran
     */
    public function detailSetor($idSetor)
    {
        try {
            $idPenggunaValid = $this->getValidIdPengguna();
            
            $setorSampah = SetorSampahModel::with(['detailSetorSampah.sampah', 'bankSampah'])
                ->where('id_setor', $idSetor)
                ->where('id_pengguna', $idPenggunaValid)
                ->firstOrFail();

            return view('user.detail-setor', compact('setorSampah'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Detail setoran tidak ditemukan');
        }
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
                ->where('status_setor', 'pending')
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