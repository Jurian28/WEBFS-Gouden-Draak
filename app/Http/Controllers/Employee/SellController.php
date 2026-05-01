<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreateOrderController;
use App\Models\Dish;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index() {
        $dishes = Dish::with(['discounts', 'type'])->get();

        $dishesByType = $dishes->groupBy(function ($dish) {
            return $dish->type->name;
        });

        return view('employee.index', [
            'dishesByType' => $dishesByType,
            'dishesList' => $dishes
        ]);
    }

    public function sell(Request $request) {
        $controller = new CreateOrderController();
        return $controller->order($request);
    }
}
