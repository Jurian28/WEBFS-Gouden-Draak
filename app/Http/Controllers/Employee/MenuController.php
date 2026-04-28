<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Dish;

class MenuController extends Controller
{
    public function dishes() {
        $dishesByType = Dish::with('type')
            ->get()
            ->groupBy(fn ($dish) => $dish->type->name);
        return view('employee.dishes', compact('dishesByType'));
    }
}
