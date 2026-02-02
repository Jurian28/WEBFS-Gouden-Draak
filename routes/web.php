<?php

use App\Http\Controllers\AuthController;
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


Route::get('/login', function () {
    return view('/kassa/login');
});

Route::get('/kassa', function () {
    return view('/kassa/index');
})->middleware(\App\Http\Middleware\Authenticate::class);

Route::post('/Authenticate', [AuthController::class, 'authenticate']);
