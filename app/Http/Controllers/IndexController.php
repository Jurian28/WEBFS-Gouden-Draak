<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        $dishesList = Dish::all();
        return view('kassa.index', compact('dishesByType', 'dishesList'));
    }

    public function dishes() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        return view('kassa.dishes', compact('dishesByType'));
    }

    public function sales() {
        dd("sales");
    }
}
