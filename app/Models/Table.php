<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'menu_type'
    ];

    public function tableRosters()
    {
        return $this->hasMany(Table_roster::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
