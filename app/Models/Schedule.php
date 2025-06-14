<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
    'date', 'day', 'time','end_time', 'class_id', 'staff_id', 'is_booked'
];


   public function class()
{
    return $this->belongsTo(\App\Models\Classes::class);
}

public function staff()
{
    return $this->belongsTo(\App\Models\Staff::class);
}


}
