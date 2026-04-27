<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'group_id'
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }
    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function getVueCart() {
        return $this->sales
            ->mapWithKeys(function ($sale) {
                return [ $sale->dish_id => $sale->amount ];
            });
    }
}
