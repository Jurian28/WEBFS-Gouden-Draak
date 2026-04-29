<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Customer\ChooseTableController;
use App\Http\Controllers\Employee\DiscountController;
use App\Http\Controllers\Employee\SalesOverviewController;
use App\Http\Controllers\Employee\TableSessionController;
use App\Http\Controllers\Employee\MenuController;
use App\Http\Controllers\Employee\SellController;
use App\Http\Controllers\Public\PublicController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('public.index');
    Route::get('/contact', 'contact')->name('public.contact');
    Route::get('/news', 'news')->name('public.news');
    Route::get('/discounts', 'discounts')->name('public.discounts');

    Route::get('/menu', 'menu')->name('public.menu');
    Route::post('/favorites/toggle', 'toggleFavorite')->name('public.favorites.toggle');
});

// EMPLOYEE ROUTES
Route::middleware('role:employee')->group(function () {
    Route::controller(SalesOverviewController::class)->group(function () {
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

    Route::controller(DiscountController::class)->group(function () {
        Route::get('/discountsList', 'index')->name('discounts');
        Route::get('/discountsList/add', 'createDiscount')->name('discounts.create.form');
        Route::post('/discountList', 'store')->name('discounts.store');
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

//ADMIN ROUTES
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\DishTypeController;

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dishes', DishController::class);
    Route::resource('dish-types', DishTypeController::class);
});

// AUTH ROUTES
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");

    Route::post('/logout', 'logout')->name('logout');
});
