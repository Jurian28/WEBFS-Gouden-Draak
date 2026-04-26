<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Group;
use App\Models\Table;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function chooseTableForm() {
        return view('customer.chooseTable');
    }
    public function chooseTable(Request $request)
    {
        // Prevent changing table once set
        if (session()->has('table_number')) {
            return redirect()->route('orderPage');
        }

        $validated = $request->validate([
            'number' => 'required|integer|min:1',
        ]);

        $table = Table::where('number', $validated['number'])->first();

        if (!$table) {
            return back()->withErrors([
                'number' => 'Tafel bestaat niet.',
            ]);
        }

        session([
            'table_number' => $table->number,
        ]);

        return redirect()->route('orderPage');
    }

    public function getTableNumber() {
        $tableNumber = session('table_number');

        return response()->json(['table_number' => $tableNumber] );
    }

    public function orderPage() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        $dishesList = Dish::all();
        return view('customer.index', compact('dishesByType', 'dishesList'));
    }


    public function history() {
        return view('customer.history');
    }
}
