<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'time',
        'end_time',
        'class_id',
        'staff_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
