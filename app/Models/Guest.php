<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'age',
        'table_id',
    ];


    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
