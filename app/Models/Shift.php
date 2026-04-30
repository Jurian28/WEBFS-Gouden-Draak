<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class, 'shift_table');
    }
}
