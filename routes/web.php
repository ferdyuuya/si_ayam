<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/test', function () {
    return view('test');
});


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

Route::get('/login', function () {
    return view('login');
});

// Route::get('/login', [LoginController::class, 'index'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
