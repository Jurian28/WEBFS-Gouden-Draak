<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'percentage',
        'start_time',
        'end_time'
    ];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_discount');
    }
}
