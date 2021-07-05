<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'company_email', 'company_address', 'city', 'state',
        'company_phone', 'company_website', 'no_of_employees', 'company_logo', 'services'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getLogoAttribute(){
        if(strpos($this->company_logo,'http') !== false)
            return $this->company_logo;
        return asset("/logos/$this->company_logo");
    }

}
