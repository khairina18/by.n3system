<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
     protected $fillable = [
        'code', 'subject', 'age', 'type_of_class', 'fee_per_hour'
    ];
    public function students()
{
    return $this->hasMany(\App\Models\Student::class, 'class_id');
}
public function tutor()
{
    return $this->belongsTo(\App\Models\Staff::class, 'staff_id');
}
public function schedules()
{
    return $this->hasMany(\App\Models\Schedule::class);
}

}
