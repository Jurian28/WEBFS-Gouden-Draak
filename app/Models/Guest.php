<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'age',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
