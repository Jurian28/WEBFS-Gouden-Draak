<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history() {
        $tableNumber = session('table_number');

        $orders = Table::where('number', $tableNumber)->first()
            ->getActiveGroup()
            ->orders()
            ->with('sales')->get();

        return view('customer.history', compact('orders'));
    }

    public function selectOrder(Request $request) {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id|integer',
        ]);

        return redirect(route('orderPage', ['selectedOrderId' => $validated['order_id']]));
    }
}
