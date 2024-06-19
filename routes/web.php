<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





Route::get('/pangan', function () {
    return view('pangan');
})->name('pangan');

Route::get('/input_pangan', function () {
    return view('input_pangan');
})->name('input_pangan');

Route::get('/ternak', function () {
    return view('ternak');
})->name('ternak');

Route::get('/input_ternak', function () {
    return view('input_ternak');
})->name('input_ternak');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');




