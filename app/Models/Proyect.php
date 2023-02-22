<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_proyects')
            ->withPivot('role')
            ->withTimestamps();
    }

}
