<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\CreateOrderController;
use App\Models\Dish;
use Illuminate\Http\Request;

class SellController
{
    public function index() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        $dishesList = Dish::all();
        return view('employee.index', compact('dishesByType', 'dishesList'));
    }

    public function sell(Request $request) {
        $controller = new CreateOrderController();
        return $controller->order($request);
    }
}
