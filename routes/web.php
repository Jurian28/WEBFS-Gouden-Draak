<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Customer\ChooseTableController;
use App\Http\Controllers\Employee\SalesOverviewController;
use App\Http\Controllers\Employee\TableSessionController;
use App\Http\Controllers\Employee\MenuController;
use App\Http\Controllers\Employee\SellController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::get('/', function () { return view('/public/index'); });
Route::get('/contact', function () { return view('/public/contact'); });
Route::get('/menukaart', function () { return view('/public/MENUKAART'); });
Route::get('/news', function () { return view('/public/news'); });

// EMPLOYEE ROUTES
Route::middleware('role:admin')->group(function () {
    Route::controller(SalesOverviewController::class)->middleware('role:admin')->group(function () {
        Route::get('/sales', 'sales')->name('sales');
        Route::get('/salesOverview', 'salesOverview')->name('salesOverview');
    });

    Route::controller(SellController::class)->group(function () {
        Route::get('/employee', 'index')->name('employee');
        Route::post('/employee', 'sell')->name('cart.sell');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('/dishes', 'dishes')->name('dishes');
    });

    Route::controller(TableSessionController::class)->group(function () {
            Route::get('/tables', 'index')->name('employee.tables');
            Route::post('/table/start', 'startTable')->name('table.start');
            Route::get('/table/{group}', 'show')->name('table.show');
            Route::post('/table/{group}/guest', 'addGuest')->name('table.guest.add');
            Route::post('/table/{group}/finish', 'finish')->name('table.finish');
        });
});

// CUSTOMER ROUTES
Route::middleware(['role:customer'])->prefix('/customer')->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::get('/index/{selectedOrderId?}', 'orderPage')->name('orderPage');
//        Route::get('/index/{selectedOrderId}', 'orderPageWithSelectedOrder')->name('orderPageWithSelectedOrder');
        Route::post('/cart/order', 'order')->name('cart.order');
    });

    Route::controller(ChooseTableController::class)->group(function () {
        Route::get('/chooseTable', 'chooseTableForm')->name('chooseTableForm');
        Route::post('/chooseTable', 'chooseTable')->name('chooseTable');
        Route::get('/tableNumber', 'getTableNumber')->name('getTableNumber');
    });

    Route::controller(HistoryController::class)->group(function () {
        Route::get('/history', 'history')->name('history');
        Route::post('/history', 'selectOrder')->name('history.order.select');
    });
});

// AUTH ROUTES
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");

    Route::post('/logout', 'logout')->name('logout');
});
