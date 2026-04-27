<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesOverviewController extends Controller
{
    public function sales() {
        $revenue = 0;
        $exclVat = (($revenue/106)*100);
        $vat = $revenue - $exclVat;
        return view('employee.sales', compact('revenue', 'exclVat', 'vat'));
    }

    public function salesOverview(Request $request) {
        $validated = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $sales = Sale::whereBetween('created_at', [
            $validated['start'],
            $validated['end']
        ])->with('dish')->get();


        $revenue = 0;
        $sales->each(function ($sale) use (&$revenue) {
            $revenue += $sale->dish->price * $sale->amount;
        });

        $exclVat = (($revenue/106)*100);
        $vat = $revenue - $exclVat;

        return view('employee.sales', compact('sales', 'revenue', 'exclVat', 'vat'));
    }
}
