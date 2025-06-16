<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'class_code'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
