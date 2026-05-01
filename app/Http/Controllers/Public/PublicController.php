<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DishType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PublicController extends Controller
{
    public function index() { return view('/public/index'); }
    public function contact() { return view('/public/contact'); }
    public function news() { return view('/public/news'); }
    public function menu(Request $request)
    {
        $types = DishType::with('dishes')->orderBy('order')->get();

        $favorites = json_decode($request->cookie('favorites', '[]'), true) ?? [];

        $filter = $request->query('filter');
        $sort = $request->query('sort');

        foreach ($types as $type) {

            $dishes = $type->dishes;

            // 👉 ONLY show favorites (filter mode)
            if ($filter === 'favorites') {
                $type->sorted_dishes = $dishes
                    ->filter(fn($d) => in_array($d->id, $favorites))
                    ->sortBy($sort === 'alpha' ? 'name' : 'menu_number');

                continue;
            }

            // 👉 UNFILTERED MODE (everything visible)

            // If no special sorting → keep original order
            if (!$sort) {
                $type->sorted_dishes = $dishes;
                continue;
            }

            // split into favorites / non-favorites
            $favoritesDishes = $dishes->filter(fn($d) => in_array($d->id, $favorites));
            $normalDishes = $dishes->reject(fn($d) => in_array($d->id, $favorites));

            // sort
            if ($sort === 'alpha') {
                $favoritesDishes = $favoritesDishes->sortBy('name');
                $normalDishes = $normalDishes->sortBy('menu_number');
            } else {
                $favoritesDishes = $favoritesDishes->sortBy('menu_number');
                $normalDishes = $normalDishes->sortBy('menu_number');
            }

            // merge (favorites always on top in sorted mode)
            $type->sorted_dishes = $favoritesDishes->concat($normalDishes);
        }

        return view('public.menu', compact('types', 'favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $dishId = (int) $request->input('dish_id');

        $favorites = json_decode($request->cookie('favorites', '[]'), true) ?? [];

        if (in_array($dishId, $favorites)) {
            $favorites = array_values(array_filter($favorites, fn($id) => $id !== $dishId));
        } else {
            $favorites[] = $dishId;
        }

        return redirect()->back()->withCookie(
            Cookie::make('favorites', json_encode($favorites), 60 * 24 * 365)
        );
    }
    public function discounts() {
        $discounts = Discount::all();
        return view('/public/discounts', compact('discounts'));
    }
}
