<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanganController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\Auth\RegisterController;

use App\Models\Ternak;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

//Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Pangan
Route::get('/pangan', [PanganController::class, 'index'])->middleware('auth')->name('pangan');
// Route::get('/input_pangan', [PanganController::class, 'add'])->middleware('auth')->name('pangan.add');
Route::post('/pangan/addStok', [PanganController::class, 'addStok'])->middleware('auth')->name('pangan.addStok');
Route::post('/pangan/subtractStock', [PanganController::class, 'subtractStok'])->middleware('auth')->name('pangan.subtractStok');
// Route::get('/pangan/export', [PanganController::class, 'exportExcel'])->middleware('auth')->name('pangan.exportExcel');
Route::get('/pangan/exportpdf', [PanganController::class, 'exportToPdf'])->middleware('auth')->name('pangan.exportToPdf');

//Ternak
Route::get('/ternak', [TernakController::class, 'index'])->name('ternak');
Route::get('/input_ternak', [TernakController::class, 'add'])->name('ternak.add');
Route::post('/input_ternak', [TernakController::class, 'store'])->name('ternak.store');
Route::match(['put', 'post'], '/ternak/end/{id}', [TernakController::class, 'update'])->name('ternak.update');
Route::get('/ternak/exportpdf', [TernakController::class, 'exportToPdf'])->middleware('auth')->name('ternak.exportToPdf');

//Profile or add user
Route::get('/profile', [RegisterController::class, 'index'])->name('profile');
Route::get('/userlist', [RegisterController::class, 'userList'])->name('profile.userlist');
Route::post('/profile', [RegisterController::class, 'storeUser'])->name('profile.store');
Route::get('/profile/{id}', [RegisterController::class, 'indexEdit'])->name('profile.edit');
Route::post('/profile/{id}', [RegisterController::class, 'editUser'])->name('profile.postedit');
Route::delete('/profile/{id}', [RegisterController::class, 'deleteUser'])->name('profile.delete');
Route::get('/changepassword/{id}', [RegisterController::class, 'changePassword'])->name('profile.changepassword');
Route::post('/changepassword/{id}', [RegisterController::class, 'updateUser'])->name('profile.update');


Route::get('/loginv2', function () {
    return view('test');
})->name('loginv2');
