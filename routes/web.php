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


// Guest (User yang belum login)
Route::get('/', function () {
    return view('landing-page/landing-page');
})->name('landing-page');
Route::get('/tentang-kami', function () {
    return view('landing-page/tentang-kami');
})->name('tentang-kami');
Route::get('/detail-layanan', function () {
    return view('landing-page/detail-layanan');
})->name('detail-layanan');
Route::get('/artikel', function () {
    return view('landing-page/artikel');
})->name('artikel');
Route::get('/landing-page/detail-artikel', function () {
    return view('landing-page/detail-artikel');
})->name('landingpage-detail-artikel');

// Autentikasi
// Route::get('/login', function () {
//     return view('auth/login');
// })->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating'])->name('authenticating');


Route::get('/register', function () {
    return view('auth/register');
})->name('register');



Route::get('/tukarpoin', function () {
    return view('tukar-poin/tukar-poin');
})->name('tukarpoin');


Route::get('user/beranda-edukasi', function () {
    return view('edukasi/beranda-edukasi');
})->name('beranda-edukasi');
Route::get('user/artikel', function () {
    return view('edukasi/artikel');
})->name('pengguna-artikel');
Route::get('user/detail-artikel', function () {
    return view('edukasi/detail-artikel');
})->name('detail-artikel');
Route::get('user/kenali-sampah', function () {
    return view('edukasi/kenali-sampah');
})->name('kenali-sampah');


Route::get('user/setor-sampah', function () {
    return view('setor-sampah/setor-sampah');
})->name('setor-sampah');
Route::get('user/setor-langsung', function () {
    return view('setor-sampah/setor-langsung');
})->name('setor-langsung');
Route::get('user/jemput-sampah', function () {
    return view('setor-sampah/jemput-sampah');
})->name('jemput-sampah');

Route::get('user/riwayat-setor-sampah', function () {
    return view('riwayat/riwayat-setor-sampah');
})->name('pengguna-riwayat-setor-sampah');
Route::get('user/riwayat-tukar-poin', function () {
    return view('riwayat/riwayat-tukar-poin');
})->name('pengguna-riwayat-tukar-poin');

Route::get('user/ubah-profil', function () {
    return view('profil/ubah-profil');
})->name('ubah-profil');
Route::get('user/ubah-password', function () {
    return view('profil/ubah-password');
})->name('ubah-password');


// Admin
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard-admin');

// Route::get('/admin/riwayat-setor-sampah', function () {
//     return view('admin/riwayat-setor-sampah');
// })->name('riwayat-setor-sampah');

Route::get('/kelola-akun', [AkunController::class, 'kelolaAkun'])->name('kelola-akun');
Route::get('/kelola-akun/data', [AkunController::class, 'akunData'])->name('kelola-akun.data');
Route::post('/add-akun', [AkunController::class, 'addAkun']);
Route::post('/edit-akun', [AkunController::class, 'editAkun']);
Route::get('/hapus-akun/{id}', [AkunController::class, 'deleteAkun']);

Route::get('/kelola-pengguna', [PenggunaController::class, 'kelolaPengguna'])->name('kelola-pengguna');
Route::get('/kelola-pengguna/data', [PenggunaController::class, 'penggunaData'])->name('kelola-pengguna.data');
Route::post('/add-pengguna', [PenggunaController::class, 'addPengguna'])->name('add-pengguna');
Route::get('/get-pengguna/{id}', [PenggunaController::class, 'getPengguna'])->name('get-pengguna');
Route::post('/edit-pengguna', [PenggunaController::class, 'editPengguna'])->name('edit-pengguna');
Route::get('/hapus-pengguna/{id}', [PenggunaController::class, 'deletePengguna'])->name('delete-pengguna');

Route::get('/kelola-artikel', [ArtikelController::class, 'kelolaArtikel'])->name('kelola-artikel');
Route::get('/kelola-artikel/data', [ArtikelController::class, 'artikelData'])->name('kelola-artikel.data');
Route::post('/add-artikel', [ArtikelController::class, 'addArtikel'])->name('add-artikel');
Route::get('/get-artikel/{id}', [ArtikelController::class, 'getArtikel'])->name('get-artikel');
Route::get('/hapus-artikel/{id}', [ArtikelController::class, 'deleteArtikel'])->name('delete-artikel');
// Tambahkan route untuk menampilkan form edit
Route::get('/detail-artikel/{id}', [ArtikelController::class, 'detailArtikel'])->name('detail-artikel.show');
Route::get('/edit-artikel/{id}', [ArtikelController::class, 'showEditArtikel'])->name('edit-artikel.show');
Route::post('/edit-artikel', [ArtikelController::class, 'editArtikel'])->name('edit-artikel');

Route::get('/admin/kelola-bank-sampah', function () {
    return view('admin/kelola-bank-sampah');
})->name('kelola-bank-sampah');

// Route::get('/admin/penukaran-donasi', function () {
//     return view('admin/penukaran-donasi');
// })->name('penukaran-donasi');

// Route::get('/admin/penukaran-barang', function () {
//     return view('admin/penukaran-barang');
// })->name('penukaran-barang');

Route::get('/kelola-sampah', [SampahController::class, 'kelolaSampah'])->name('kelola-sampah');
Route::get('/sampah-data', [SampahController::class, 'sampahData'])->name('sampah.data');

// Sampah CRUD
Route::post('/add-sampah', [SampahController::class, 'addSampah']);
Route::post('/edit-sampah', [SampahController::class, 'editSampah']);
Route::get('/hapus-sampah/{id}', [SampahController::class, 'deleteSampah']);

// Jenis Sampah CRUD
Route::post('/add-jenis-sampah', [SampahController::class, 'addJenisSampah']);
Route::post('/edit-jenis-sampah', [SampahController::class, 'editJenisSampah']);
Route::get('/hapus-jenis-sampah/{id}', [SampahController::class, 'deleteJenisSampah']);
    
Route::get('/penukaran-barang', [TransaksiBarangController::class, 'kelolaBarang'])->name('penukaran-barang');
Route::get('/barang/data', [TransaksiBarangController::class, 'barangData'])->name('barang.data');
Route::get('/riwayat-penukaran/data', [TransaksiBarangController::class, 'riwayatPenukaranData'])->name('riwayat.penukaran.data');
Route::post('/barang/add', [TransaksiBarangController::class, 'addBarang'])->name('barang.add');
Route::post('/barang/edit', [TransaksiBarangController::class, 'editBarang'])->name('barang.edit');
Route::get('/barang/delete/{id}', [TransaksiBarangController::class, 'deleteBarang'])->name('barang.delete');


// Main page
Route::get('/penukaran-donasi', [TransaksiDonasiController::class, 'kelolaDonasi'])->name('penukaran-donasi');
Route::get('/donasi/data', [TransaksiDonasiController::class, 'donasiData'])->name('donasi.data');
Route::get('/riwayat-penukaran-donasi/data', [TransaksiDonasiController::class, 'riwayatPenukaranData'])->name('riwayat.penukaran.donasi.data');
Route::post('/donasi/add', [TransaksiDonasiController::class, 'addDonasi'])->name('donasi.add');
Route::post('/donasi/edit', [TransaksiDonasiController::class, 'editDonasi'])->name('donasi.edit');
Route::get('/donasi/delete/{id}', [TransaksiDonasiController::class, 'deleteDonasi'])->name('donasi.delete');
Route::get('/donasi/get/{id}', [TransaksiDonasiController::class, 'getDonasi'])->name('donasi.get');


Route::get('/admin/setor-sampah', [SetorSampahController::class, 'kelolaSetorSampah'])->name('riwayat-setor-sampah');
Route::get('/admin/setor-sampah/data', [SetorSampahController::class, 'setorSampahData'])->name('admin.setor-sampah.data');
Route::put('/admin/setor-sampah/update/{id}', [SetorSampahController::class, 'editSetorSampah'])->name('admin.setor-sampah.update');
Route::post('/admin/setor-sampah/add', [SetorSampahController::class, 'addSetorSampah'])->name('admin.setor-sampah.add');
Route::get('/admin/setor-sampah/delete/{id}', [SetorSampahController::class, 'deleteSetorSampah'])->name('admin.setor-sampah.delete');
Route::get('/admin/setor-sampah/detail/{id}', [SetorSampahController::class, 'getDetailSetorSampah'])->name('admin.setor-sampah.get-detail');