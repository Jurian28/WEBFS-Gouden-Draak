<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'number'
    ];

    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function getActiveGroup(){
        return $this->groups()->where('active', 1)->first();
    }
}
