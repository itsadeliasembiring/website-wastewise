<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page/landing-page');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');
Route::get('/register', function () {
    return view('auth/register');
})->name('register');


Route::get('/register/ayam', function () {
    return view('auth/register');
})->name('register');