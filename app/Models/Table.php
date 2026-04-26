<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'number'
    ];

    public function tableRosters()
    {
        return $this->hasMany(Table_roster::class);
    }
}
