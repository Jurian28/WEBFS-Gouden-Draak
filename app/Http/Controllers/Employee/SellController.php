<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreateOrderController;
use App\Models\Dish;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index() {
        $dishes = Dish::with('discounts')->get();

        $dishesByType = $dishes->groupBy('type_dish');
        $dishesList = $dishes;

        return view('employee.index', compact('dishesByType', 'dishesList'));
    }

    public function sell(Request $request) {
        $controller = new CreateOrderController();
        return $controller->order($request);
    }
}
