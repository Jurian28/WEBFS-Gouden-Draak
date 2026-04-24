<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SellController;
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



Route::controller(IndexController::class)->middleware('auth')->group(function () {
    Route::get('/kassa', 'index')->name('kassa');
    Route::get('/dishes', 'dishes')->name('dishes');
    Route::get('/sales', 'sales')->name('sales');
    Route::get('/salesOverview', 'salesOverview')->name('salesOverview');
});

Route::controller(SellController::class)->middleware('auth')->group(function () {
    Route::post('/cart/sell', 'sell')->name('cart.sell');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");

    Route::post('/logout', 'logout')->name('logout');
});

