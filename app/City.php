<?php

namespace App;


use App\Employee;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \App\Http\Traits\UsesUuid;
    
    protected $fillable = ['name', 'states_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
