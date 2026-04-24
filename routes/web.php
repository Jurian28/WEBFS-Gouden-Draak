<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/klant/index');
});
Route::get('/contact', function () {
    return view('/klant/contact');
});
Route::get('/menukaart', function () {
    return view('/klant/MENUKAART');
});
Route::get('/news', function () {
    return view('/klant/news');
});



Route::get('/kassa', [IndexController::class, 'index'])->middleware(Authenticate::class)->name('kassa');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");

    Route::post('/logout', 'logout')->name('logout');
});

