<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public function schedules()
{
    return $this->hasMany(\App\Models\Schedule::class);
}

    protected $fillable = [
    'name', 'email', 'role'
];


}
