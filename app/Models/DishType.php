<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishType extends Model
{
    protected $fillable = [
        'name',
        'order',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
