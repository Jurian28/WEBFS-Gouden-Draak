<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Group;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Table;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    public function order(Request $request) {
        $validated = $request->validate([
            'cart' => 'required|array',
            'table_number' => 'table|integer'
        ]);

        $cart = $validated['cart'];
        $group = Table::where('number', $validated['table_number'])->first()
            ->getActiveGroup();

        if (!$group) {
            return response()->json([
                'success' => false,
                'message' => 'Geen groep gevonden voor deze tafel'
            ]);
        }

        $order = new Order([
            'group_id' => $group->id,
        ]);
        $order->save();

        foreach ($cart as $id => $amount) {
            $dish = Dish::with('discounts')->findOrFail($id);

            $dishPrice = $dish->discountedPrice();

            $sale = new Sale([
                'dish_id' => $id,
                'amount' => $amount,
                'price' => $dishPrice,
                'order_id' => $order->id
            ]);

            $sale->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order geplaatst'
        ]);
    }
}
