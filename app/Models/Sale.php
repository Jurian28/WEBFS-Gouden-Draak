<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'dish_id',
        'order_id',
        'rice_type_id',
        'price',
        'amount',
        'sale_date',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function riceType()
    {
        return $this->belongsTo(Rice_type::class);
    }
}
