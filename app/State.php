<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'countries_id'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
