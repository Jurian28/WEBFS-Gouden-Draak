<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Group;
use App\Models\Sale;
use App\Models\Table;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    public function order(Request $request) {
        $validated = $request->validate([
            'cart' => 'required|array',
            'table_number' => 'required|integer'
        ]);

        $cart = $validated['cart'];
        $table = Table::where('number', $validated['table_number'])->first();
        $group = Group::where('table_id', $table->id)
            ->where('active', true)
            ->first();

        if (!$group) {
            return response()->json([
                'success' => false,
                'message' => 'Geen group gevonden voor deze tafel'
            ]);
        }

        foreach ($cart as $id => $amount) {
            $dishPrice = Dish::find($id)->price;

            $sale = new Sale([
                'dish_id' => $id,
                'amount' => $amount,
                'price' => $dishPrice,
                'group_id' => $group->id
            ]);

            $sale->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order placed'
        ]);
    }
}
