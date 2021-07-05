<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
