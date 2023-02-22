<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    public function proyects()
    {
        return $this->belongsToMany(Proyect::class, 'employee_proyects')
            ->withPivot('role')
            ->withTimestamps();
    }
}
