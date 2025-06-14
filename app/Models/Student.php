<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function payments()
{
    return $this->hasMany(Payment::class);
}
    protected $fillable = ['name', 'email', 'age'];

}


