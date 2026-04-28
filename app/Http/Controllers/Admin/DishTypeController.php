<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DishType;
use Illuminate\Http\Request;

class DishTypeController extends Controller
{
    public function index()
    {
        $types = DishType::orderBy('order')->get();

        return view('admin.dish_types.index', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:dish_types,name',
            'order' => 'nullable|integer',
        ]);

        DishType::create([
            'name' => $data['name'],
            'order' => $data['order'] ?? 0,
        ]);

        return redirect()->route('admin.dishes.index');
    }

    public function update(Request $request, DishType $dishType)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $dishType->update([
            'name' => $data['name'],
            'order' => $data['order'] ?? 0,
        ]);

        return redirect()->route('admin.dishes.index');
    }

    public function destroy(DishType $dishType)
    {
        $dishType->delete();

        return redirect()->route('admin.dishes.index');
    }
}
