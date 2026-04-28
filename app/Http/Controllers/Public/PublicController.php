<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DishType;

class PublicController extends Controller
{
    public function index() { return view('/public/index'); }
    public function contact() { return view('/public/contact'); }
    public function news() { return view('/public/news'); }

    public function menu() {
        $types = DishType::with('dishes')->orderBy('order')->get();
        return view('/public/menu', compact('types'));
    }

    public function discounts() {
        $discounts = Discount::all();
        return view('/public/discounts', compact('discounts'));
    }
}
