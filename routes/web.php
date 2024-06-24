<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanganController;
use App\Http\Controllers\TernakController;
use App\Models\Ternak;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

//Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Pangan
Route::get('/pangan', [PanganController::class, 'index'])->name('pangan');
Route::get('/input_pangan', [PanganController::class, 'add_index'])->name('input_pangan');


//Ternak
Route::get('/ternak', [TernakController::class, 'index'])->name('ternak');
Route::get('/input_ternak', [TernakController::class, 'add'])->name('ternak.add');
Route::post('/input_ternak', [TernakController::class, 'store'])->name('ternak.store');
Route::match(['put', 'post'], '/ternak/end/{id}', [TernakController::class, 'update'])->name('ternak.update');


Route::get('/profile', function () {
    return view('profile');
})->name('profile');
