<?php

namespace App\Http\Controllers\Employee;

use App\Models\Dish;

class MenuController
{
    public function dishes() {
        $dishesByType = Dish::all()->groupBy('type_dish');
        return view('employee.dishes', compact('dishesByType'));
    }
}
