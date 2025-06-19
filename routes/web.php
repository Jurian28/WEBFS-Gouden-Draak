<?php

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
Route::get('/rotzooi', function () {
    return view('/klant/rotzooi');
});
