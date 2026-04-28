<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Dish;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() { return view('/public/index'); }
    public function contact() { return view('/public/contact'); }
    public function menu() { return view('/public/menu'); }
    public function news() { return view('/public/news'); }

    public function discounts() {
        $discounts = Discount::all();
        return view('/public/discounts', compact('discounts'));
    }
}
