<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page/landing-page');
});
Route::get('/artikel', function () {
    return view('landing-page/artikel');
});
Route::get('/tentang-kami', function () {
    return view('landing-page/tentang-kami');
});
Route::get('/detail-layanan', function () {
    return view('landing-page/detail-layanan');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');
Route::get('/register', function () {
    return view('auth/register');
})->name('register');


Route::get('/tukarpoin', function () {
    return view('tukar-poin/tukar-poin');
})->name('tukarpoin');

Route::get('/ubah-profil', function () {
    return view('profil/ubah-profil');
})->name('ubah-profil');
Route::get('/ubah-password', function () {
    return view('profil/ubah-password');
})->name('ubah-password');

Route::get('/beranda-edukasi', function () {
    return view('edukasi/beranda-edukasi');
})->name('beranda-edukasi');
Route::get('/detail-artikel', function () {
    return view('edukasi/detail-artikel');
})->name('detail-artikel');
Route::get('/kenali-sampah', function () {
    return view('edukasi/kenali-sampah');
})->name('kenali-sampah');


Route::get('/setor-sampah', function () {
    return view('setor-sampah/setor-sampah');
})->name('setor-sampah');
Route::get('/setor-langsung', function () {
    return view('setor-sampah/setor-langsung');
})->name('setor-langsung');
Route::get('/jemput-sampah', function () {
    return view('setor-sampah/jemput-sampah');
})->name('jemput-sampah');

Route::get('/riwayat-setor-sampah', function () {
    return view('riwayat/riwayat-setor-sampah');
})->name('riwayat-setor-sampah');
Route::get('/riwayat-tukar-poin', function () {
    return view('riwayat/riwayat-tukar-poin');
})->name('riwayat-tukar-poin');