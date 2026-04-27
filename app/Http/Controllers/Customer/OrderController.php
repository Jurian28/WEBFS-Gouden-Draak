<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function orderPage() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        $dishesList = Dish::all();
        return view('customer.index', compact('dishesByType', 'dishesList'));
    }


}
