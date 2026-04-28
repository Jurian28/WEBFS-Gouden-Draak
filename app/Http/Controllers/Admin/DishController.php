<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishType;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::with('type')
            ->orderBy('menu_number')
            ->get();

        $types = DishType::orderBy('order')->get();

        return view('admin.dishes.index', compact('dishes', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_number' => 'required|integer',
            'menu_affix' => 'nullable|string|max:5',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'dish_type_id' => 'required|exists:dish_types,id',
        ]);

        $exists = Dish::where('menu_number', $data['menu_number'])
            ->where('menu_affix', $data['menu_affix'] ?? null)
            ->exists();

        if ($exists) {
            return back()->withErrors('Menu number + affix must be unique');
        }

        Dish::create($data);

        return redirect()->route('admin.dishes.index');
    }

    public function update(Request $request, Dish $dish)
    {
        $data = $request->validate([
            'menu_number' => 'required|integer',
            'menu_affix' => 'nullable|string|max:5',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'dish_type_id' => 'required|exists:dish_types,id',
        ]);

        $exists = Dish::where('menu_number', $data['menu_number'])
            ->where('menu_affix', $data['menu_affix'] ?? null)
            ->where('id', '!=', $dish->id)
            ->exists();

        if ($exists) {
            return back()->withErrors('Menu number + affix must be unique');
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.index');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }
}
