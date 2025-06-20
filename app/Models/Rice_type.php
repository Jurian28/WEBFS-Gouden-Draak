<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rice_type extends Model
{
    protected $fillable = [
        'description',
        'price',
    ];


    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
