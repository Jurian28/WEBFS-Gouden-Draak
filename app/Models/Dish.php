<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'menu_number',
        'menu_affix',
        'name',
        'price',
        'type_dish',
        'description',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'dish_discount');
    }
}
