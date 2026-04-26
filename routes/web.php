<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TableSessionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SellController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/public/index');
});
Route::get('/contact', function () {
    return view('/public/contact');
});
Route::get('/menukaart', function () {
    return view('/public/MENUKAART');
});
Route::get('/news', function () {
    return view('/public/news');
});



Route::controller(IndexController::class)->middleware('role:admin')->group(function () {
    Route::get('/kassa', 'index')->name('kassa');
    Route::get('/dishes', 'dishes')->name('dishes');
    Route::get('/sales', 'sales')->name('sales');
    Route::get('/salesOverview', 'salesOverview')->name('salesOverview');
});

Route::controller(SellController::class)->group(function () {
    Route::post('/cart/sell', 'sell')->name('cart.sell')->middleware('role:admin,customer');
});

Route::controller(CustomerController::class)->middleware('role:customer')->group(function () {
    Route::get('/customer/chooseTable', 'chooseTableForm')->name('chooseTableForm');
    Route::post('/customer/chooseTable', 'chooseTable')->name('chooseTable');
    Route::get('/customer/tableNumber', 'getTableNumber')->name('getTableNumber');

    Route::get('/customer/index', 'orderPage')->name('orderPage');

    Route::get('/customer/history', 'history')->name('history');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");

    Route::post('/logout', 'logout')->name('logout');
});


Route::middleware(['role:admin'])
    ->controller(TableSessionController::class)
    ->prefix('kassa')
    ->group(function () {

        Route::get('/tables', 'index')
            ->name('kassa.tables');

        Route::post('/table/start', 'startTable')
            ->name('table.start');

        Route::get('/table/{group}', 'show')
            ->name('table.show');

        Route::post('/table/{group}/guest', 'addGuest')
            ->name('table.guest.add');

        Route::post('/table/{group}/finish', 'finish')
            ->name('table.finish');
    });
