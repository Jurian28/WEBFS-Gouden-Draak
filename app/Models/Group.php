<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'menu_type',
        'table_id',
        'active'
    ];

    public function table() {
        return $this->belongsTo(Table::class);
    }
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
