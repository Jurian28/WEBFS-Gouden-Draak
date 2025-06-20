<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table_roster extends Model
{
    protected $fillable = [
        'user_id',
        'table_id',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
