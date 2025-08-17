<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SetorSampahController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\TransaksiDonasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TukarPoinController;
use App\Http\Controllers\TransaksiSetorSampahController;
use App\Http\Controllers\VerifikasiSetorSampahController;
use App\Http\Controllers\VerifikasiTukarBarangController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ChatbotController;

// Guest (User yang belum login)
// Route::get('/', function () {
//     return view('landing-page/landing-page');
// })->name('landing-page');

// Route::get('/tentang-kami', function () {
//     return view('landing-page/tentang-kami');
// })->name('tentang-kami');

// Route::get('/detail-layanan', function () {
//     return view('landing-page/detail-layanan');
// })->name('detail-layanan');

// // Hanya pakai salah satu route untuk /artikel
// Route::get('/artikel', [ArtikelController::class, 'berandaEdukasi'])->name('artikel');

// Route::get('/landing-page/detail-artikel', function () {
//     return view('landing-page/detail-artikel');
// })->name('landingpage-detail-artikel');

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/wastewise-artikel', [LandingPageController::class, 'daftarArtikel'])->name('daftar-artikel-guest');
Route::get('/wastewise-artikel/{id}', [LandingPageController::class, 'detailArtikelPengguna'])->name('detail-artikel-guest');
Route::get('/wastewise-tentang-kami', [LandingPageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/wastewise-detail-layanan', [LandingPageController::class, 'detailLayanan'])->name('detail-layanan');
Route::get('/artikel', [ArtikelController::class, 'daftarArtikel'])->name('daftar-artikel');

// Autentikasi
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating'])->name('authenticating');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-form', [RegisterController::class, 'register'])->name('register-form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/get-kelurahan/{kecamatan_id}', [RegisterController::class, 'getKelurahanByKecamatan'])->name('kelurahan.by.kecamatan');

// =========================================PENGGUNA====================
Route::middleware(['auth', 'pengguna'])->group(function () {
    // Edukasi
    // Beranda Edukasi - halaman utama dengan artikel terbaru
    Route::get('/beranda-edukasi', [ArtikelController::class, 'berandaEdukasi'])->name('beranda-edukasi');
    // Daftar semua artikel dengan pagination dan search
    Route::get('/daftar-artikel', [ArtikelController::class, 'daftarArtikel'])->name('daftar-artikel');
    // Detail artikel untuk pengguna
    Route::get('/artikel/{id}/detail', [ArtikelController::class, 'detailArtikelPengguna'])->name('detail-artikel');
    Route::get('user/kenali-sampah', function () {
        return view('edukasi/kenali-sampah');
    })->name('kenali-sampah');
    Route::post('/chat', [ChatbotController::class, 'handleChat']); 
    Route::get('/cek-ip', function () {
        return file_get_contents('https://ipinfo.io');
    });
    
    Route::get('/artikel', [ArtikelController::class, 'berandaEdukasi'])->name('artikel');
    // Halaman Profil Pengguna
    Route::get('user/ubah-profil', [PenggunaController::class, 'showProfile'])->name('ubah-profil');
    Route::post('/profil/update', [PenggunaController::class, 'updateProfile'])->name('profil.update');
    Route::get('/kelurahan/{kecamatan_id}', [PenggunaController::class, 'getKelurahanByKecamatan'])->name('kelurahan.by.kecamatan');
    // Halaman Ubah Password
    Route::get('/ubah-password', [PenggunaController::class, 'showChangePassword'])->name('pengguna.ubah-password');    
    Route::post('/update-password', [PenggunaController::class, 'updatePassword'])->name('pengguna.update-password');


    // Route untuk menampilkan halaman tukar poin
    Route::get('/tukar-poin', [TukarPoinController::class, 'index'])->name('tukar-poin');    
    // Route untuk menukar poin dengan barang (AJAX)
    Route::post('/tukar-poin/barang', [TukarPoinController::class, 'tukarBarang'])->name('tukar.barang');
    // Route untuk menukar poin dengan donasi (AJAX)
    Route::post('/tukar-poin/donasi', [TukarPoinController::class, 'tukarDonasi'])->name('tukar.donasi');    
    // Route untuk melihat riwayat penukaran poin
    Route::get('user/riwayat-tukar-poin', [TukarPoinController::class, 'riwayatTukarPoin'])->name('pengguna-riwayat-tukar-poin');
    // Route untuk mengecek status redeem barang (AJAX)
    Route::post('/cek-status-redeem', [TukarPoinController::class, 'cekStatusRedeem'])->name('cek.status.redeem');


    // Halaman Setor Sampah (langsung)
    Route::get('/user/setor-sampah', [TransaksiSetorSampahController::class, 'index'])->name('setor-sampah');
    Route::get('/setor-langsung', [TransaksiSetorSampahController::class, 'setorLangsung'])
        ->name('setor-langsung');
    // Proses Setor Langsung (AJAX)
    Route::post('/setor-langsung/proses', [TransaksiSetorSampahController::class, 'prosesSetorLangsung'])
        ->name('proses-setor-langsung');
    // Riwayat Setoran
    Route::get('/user/riwayat-setor-sampah', [TransaksiSetorSampahController::class, 'riwayatSetorSampah'])
        ->name('pengguna-riwayat-setor-sampah');
    // Detail Setoran
    Route::get('/user/riwayat-setor-sampah/{idSetor}/detail', [TransaksiSetorSampahController::class, 'detailSetorSampah'])
        ->name('detail-setor');
    // Batalkan Setoran (AJAX)
    Route::patch('/setor/{idSetor}/batalkan', [TransaksiSetorSampahController::class, 'batalkanSetor'])
        ->name('batalkan-setor');
    // Cek Status Setoran (AJAX)
    Route::get('/setor/{idSetor}/status', [TransaksiSetorSampahController::class, 'cekStatusSetor'])
        ->name('cek-status-setor');
    // Get Data Jenis Sampah (untuk AJAX/API)
    Route::get('/api/jenis-sampah', [TransaksiSetorSampahController::class, 'getJenisSampah'])
        ->name('api.jenis-sampah');


    // Halaman Jemput Sampah
    Route::get('/jemput-sampah', [TransaksiSetorSampahController::class, 'jemputSampah'])
        ->name('jemput-sampah');
    // Proses Jemput Sampah (AJAX)
    Route::post('/jemput-sampah/proses', [TransaksiSetorSampahController::class, 'prosesJemputSampah'])
        ->name('proses-jemput-sampah');
    // Get Jadwal Tersedia (AJAX)
    Route::get('/api/jadwal-tersedia', [TransaksiSetorSampahController::class, 'getJadwalTersedia'])
        ->name('api.jadwal-tersedia');
    // Riwayat Penjemputan
    Route::get('/riwayat-penjemputan', [TransaksiSetorSampahController::class, 'riwayatPenjemputan'])
        ->name('riwayat-penjemputan');
    // Detail Penjemputan
    Route::get('/penjemputan/{idSetor}/detail', [TransaksiSetorSampahController::class, 'detailPenjemputan'])
        ->name('detail-penjemputan');
    // Batalkan Penjemputan (AJAX)
    Route::patch('/penjemputan/{idSetor}/batalkan', [TransaksiSetorSampahController::class, 'batalkanPenjemputan'])
        ->name('batalkan-penjemputan');
    // Cek Status Penjemputan (AJAX)
    Route::get('/penjemputan/{idSetor}/status', [TransaksiSetorSampahController::class, 'cekStatusPenjemputan'])
        ->name('cek-status-penjemputan');


});

// ======================= ADMIN =======================
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-admin');
    Route::get('/api/chart-data', [DashboardController::class, 'getChartData'])->name('admin.api.chart.data');
    Route::get('/api/refresh-stats', [DashboardController::class, 'refreshStats'])->name('admin.api.refresh.stats');
    Route::get('/api/monthly-trends', [DashboardController::class, 'getMonthlyTrends'])->name('admin.api.monthly.trends');

    // verifikasi setor sampah
    Route::get('verifikasi-setor-sampah', [VerifikasiSetorSampahController::class, 'index'])
        ->name('admin.verifikasi-setor-sampah');
    Route::post('verifikasi/cari-kode', [VerifikasiSetorSampahController::class, 'cariKodeVerifikasi'])
        ->name('admin.verifikasi.cari-kode');
    Route::post('verifikasi/update-berat', [VerifikasiSetorSampahController::class, 'updateBeratSampah'])
        ->name('admin.verifikasi.update-berat');
    Route::post('verifikasi/verifikasi-setor', [VerifikasiSetorSampahController::class, 'verifikasiSetor'])
        ->name('admin.verifikasi.verifikasi-setor');
    Route::delete('verifikasi/hapus-detail', [VerifikasiSetorSampahController::class, 'hapusDetailSetor'])
        ->name('admin.verifikasi.hapus-detail');
    Route::get('verifikasi/daftar-sampah', [VerifikasiSetorSampahController::class, 'getDaftarSampah'])
        ->name('admin.verifikasi.daftar-sampah');
    Route::post('verifikasi/tambah-detail', [VerifikasiSetorSampahController::class, 'tambahDetailSetor'])
        ->name('admin.verifikasi.tambah-detail');


    // Verifikasi Tukar Barang
    Route::get('/verifikasi-tukar-barang', [VerifikasiTukarBarangController::class, 'index'])->name('admin.beranda-verifikasi-tukar-barang');
    // Cari kode verifikasi
    Route::post('/cari-kode-tukar-barang', [VerifikasiTukarBarangController::class, 'cariKode'])->name('admin.cari-kode-tukar-barang');
    // Verifikasi penukaran
    Route::post('/verifikasi-tukar-barang', [VerifikasiTukarBarangController::class, 'verifikasi'])->name('admin.submit-verifikasi-tukar-barang');
    // Get pending exchanges untuk DataTables
    Route::get('/pending-tukar-barang', [VerifikasiTukarBarangController::class, 'getPendingExchanges'])->name('admin.penukaran-pending');
    // Get detail penukaran
    Route::get('tukar-barang/detail/{id}', [VerifikasiTukarBarangController::class, 'getDetail'])->name('admin.tukar-barang-detail');
    
    // Kelola Setor Sampah
    Route::get('setor-sampah', [SetorSampahController::class, 'kelolaSetorSampah'])->name('riwayat-setor-sampah');
    Route::get('setor-sampah/data', [SetorSampahController::class, 'setorSampahData'])->name('admin.setor-sampah.data');
    Route::put('setor-sampah/update/{id}', [SetorSampahController::class, 'editSetorSampah'])->name('admin.setor-sampah.update');
    Route::post('setor-sampah/add', [SetorSampahController::class, 'addSetorSampah'])->name('admin.setor-sampah.add');
    Route::get('setor-sampah/delete/{id}', [SetorSampahController::class, 'deleteSetorSampah'])->name('admin.setor-sampah.delete');
    Route::get('setor-sampah/detail/{id}', [SetorSampahController::class, 'getDetailSetorSampah'])->name('admin.setor-sampah.get-detail');

    // Kelola Akun
    Route::get('/kelola-akun', [AkunController::class, 'kelolaAkun'])->name('kelola-akun');
    Route::get('/kelola-akun/data', [AkunController::class, 'akunData'])->name('kelola-akun.data');
    Route::post('/add-akun', [AkunController::class, 'addAkun']);
    Route::post('/edit-akun', [AkunController::class, 'editAkun']);
    Route::get('/hapus-akun/{id}', [AkunController::class, 'deleteAkun']);

    // Kelola Pengguna
    Route::get('/kelola-pengguna', [PenggunaController::class, 'kelolaPengguna'])->name('kelola-pengguna');
    Route::get('/kelola-pengguna/data', [PenggunaController::class, 'penggunaData'])->name('kelola-pengguna.data');
    Route::post('/add-pengguna', [PenggunaController::class, 'addPengguna'])->name('add-pengguna');
    Route::get('/get-pengguna/{id}', [PenggunaController::class, 'getPengguna'])->name('get-pengguna');
    Route::post('/edit-pengguna', [PenggunaController::class, 'editPengguna'])->name('edit-pengguna');
    Route::get('/hapus-pengguna/{id}', [PenggunaController::class, 'deletePengguna'])->name('delete-pengguna');

    // Kelola Artikel
    Route::get('/kelola-artikel', [ArtikelController::class, 'kelolaArtikel'])->name('kelola-artikel');
    Route::get('/kelola-artikel/data', [ArtikelController::class, 'artikelData'])->name('kelola-artikel.data');
    Route::post('/add-artikel', [ArtikelController::class, 'addArtikel'])->name('add-artikel');
    Route::get('/get-artikel/{id}', [ArtikelController::class, 'getArtikel'])->name('get-artikel');
    Route::get('/hapus-artikel/{id}', [ArtikelController::class, 'deleteArtikel'])->name('delete-artikel');
    Route::get('/detail-artikel/{id}', [ArtikelController::class, 'detailArtikel'])->name('detail-artikel.show');
    Route::get('/edit-artikel/{id}', [ArtikelController::class, 'showEditArtikel'])->name('edit-artikel.show');
    Route::post('/edit-artikel', [ArtikelController::class, 'editArtikel'])->name('edit-artikel');

    // Kelola Sampah 
    Route::get('/sampah-data', [SampahController::class, 'sampahData'])->name('sampah.data');
    Route::get('/kelola-sampah', [SampahController::class, 'kelolaSampah'])->name('kelola-sampah');
    Route::post('/add-sampah', [SampahController::class, 'addSampah']);
    Route::post('/edit-sampah', [SampahController::class, 'editSampah']);
    Route::get('/hapus-sampah/{id}', [SampahController::class, 'deleteSampah']);

    // Kelola Jenis Sampah
    Route::post('/add-jenis-sampah', [SampahController::class, 'addJenisSampah']);
    Route::post('/edit-jenis-sampah', [SampahController::class, 'editJenisSampah']);
    Route::get('/hapus-jenis-sampah/{id}', [SampahController::class, 'deleteJenisSampah']);

    // Kelola Penukaran Barang
    Route::get('/penukaran-barang', [TransaksiBarangController::class, 'kelolaBarang'])->name('penukaran-barang');
    Route::get('/barang/data', [TransaksiBarangController::class, 'barangData'])->name('barang.data');
    Route::get('/riwayat-penukaran/data', [TransaksiBarangController::class, 'riwayatPenukaranData'])->name('riwayat.penukaran.data');
    Route::post('/barang/add', [TransaksiBarangController::class, 'addBarang'])->name('barang.add');
    Route::post('/barang/edit', [TransaksiBarangController::class, 'editBarang'])->name('barang.edit');
    Route::get('/barang/delete/{id}', [TransaksiBarangController::class, 'deleteBarang'])->name('barang.delete');

    // Kelola Penukaran Donasi
    Route::get('/penukaran-donasi', [TransaksiDonasiController::class, 'kelolaDonasi'])->name('penukaran-donasi');
    Route::get('/donasi/data', [TransaksiDonasiController::class, 'donasiData'])->name('donasi.data');
    Route::get('/riwayat-penukaran-donasi/data', [TransaksiDonasiController::class, 'riwayatPenukaranData'])->name('riwayat.penukaran.donasi.data');
    Route::post('/donasi/add', [TransaksiDonasiController::class, 'addDonasi'])->name('donasi.add');
    Route::post('/donasi/edit', [TransaksiDonasiController::class, 'editDonasi'])->name('donasi.edit');
    Route::get('/donasi/delete/{id}', [TransaksiDonasiController::class, 'deleteDonasi'])->name('donasi.delete');
    Route::get('/donasi/get/{id}', [TransaksiDonasiController::class, 'getDonasi'])->name('donasi.get');
});
