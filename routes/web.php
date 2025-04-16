<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth/login');
})->name('login');
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

// {{ route('/') }}

// Admin
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard-admin');

Route::get('/admin/riwayat-setor-sampah', function () {
    return view('admin/riwayat-setor-sampah');
})->name('riwayat-setor-sampah');

Route::get('/admin/kelola-akun', function () {
    return view('admin/kelola-akun');
})->name('kelola-akun');

Route::get('/admin/kelola-bank-sampah', function () {
    return view('admin/kelola-bank-sampah');
})->name('kelola-bank-sampah');

Route::get('/admin/kelola-pengguna', function () {
    return view('admin/kelola-pengguna');
})->name('kelola-pengguna');

Route::get('/admin/kelola-artikel', function () {
    return view('admin/kelola-artikel');
})->name('kelola-artikel');

Route::get('/admin/penukaran-donasi', function () {
    return view('admin/penukaran-donasi');
})->name('penukaran-donasi');

Route::get('/admin/penukaran-barang', function () {
    return view('admin/penukaran-barang');
})->name('penukaran-barang');

Route::get('/admin/kelola-sampah', function () {
    return view('admin/kelola-sampah');
})->name('kelola-sampah');