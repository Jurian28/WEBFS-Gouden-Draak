<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreateOrderController;
use App\Models\Dish;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        $dishesList = Dish::all();
        return view('customer.index', compact('dishesByType', 'dishesList'));
    }

    public function order(Request $request) {
        $controller = new CreateOrderController();
        return $controller->order($request);
    }
}
