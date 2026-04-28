<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Dish;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index() {
        $discounts = Discount::with('dishes')->latest()->get();

        return view('employee.discounts.index', compact('discounts'));
    }

    public function createDiscount() {
        $dishes = Dish::all();
        return view('employee.discounts.createDiscount', compact('dishes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dishes' => 'required|array',
            'percentage' => 'required|numeric|min:1|max:100',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $discount = Discount::create([
            'percentage' => $request->percentage,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $discount->dishes()->attach($request->dishes);

        return redirect()->route('discounts');
    }
}
