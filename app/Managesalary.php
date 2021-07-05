<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Managesalary extends Model
{
    protected $fillable = [
        'employee_name', 'designation_type', 'working_days', 'tax', 'gross_salary','invoice_number'
    ];


    public function employee()
    {
        return $this->belongsTo('App\Employee',);
    }

    public function advanceSum()
    {
        return $this->hasMany('App\Advancepayment')
            ->selectRaw('SUM(amount) as total')
            ->groupBy('employee_id');
    }
}
