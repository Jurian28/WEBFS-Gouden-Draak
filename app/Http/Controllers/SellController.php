<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Sale;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function sell(Request $request) {
        $validated = $request->validate([
            'cart' => 'required|array',
        ]);

        foreach ($validated["cart"] as $id => $amount) {
            $dishPrice = Dish::find($id)->price;

            $sale = new Sale([
                'dish_id' => $id,
                'amount' => $amount,
                'price' => $dishPrice
            ]);

            $sale->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order placed'
        ]);
    }
}
