<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CreateOrderController;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage(?int $selectedOrderId = null) {
        $dishes = Dish::with('discounts')->get();

        $dishesList = $dishes;
        $dishesByType = $dishes->groupBy(function ($dish) {
            return $dish->type->name;
        });

        if ($selectedOrderId) {
            $order = Order::find($selectedOrderId);
            $cart = $order ? $order->getVueCart() : null;
        } else {
            $cart = null;
        }

        return view('customer.index', compact('dishesByType', 'dishesList', 'cart'));

    }

    public function order(Request $request) {
        $controller = new CreateOrderController();
        return $controller->order($request);
    }
}
