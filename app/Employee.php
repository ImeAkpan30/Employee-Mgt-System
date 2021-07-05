<?php

namespace App;


use Image;
use App\City;
use App\User;
use App\State;
use App\Company;
use App\Country;
use App\Division;
use App\Department;
use App\Designation;
use App\Advancepayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'address', 'job_type', 'gender', 'phone', 'emergency_contact', 'companies_id', 'cities_id', 'states_id', 'countries_id', 'zip', 'age', 'salary', 'birthdate',
        'date_hired', 'departments_id', 'divisions_id', 'picture', 'retrieve_image'
    ];

    // public static function uploadEmployeeImage($image)
    // {
    //     $file_name = time().'.'.$image->getClientOriginalExtension();
    //     $image_resize = Image::make($image->getRealPath());
    //     $image_resize->resize(400,400);
    //     $image_resize->save(public_path(). '/images/'.$file_name);

    //     $input['picture'] = $file_name;
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cities()
    {
        return $this->belongsTo(City::class);
    }
    public function departments()
    {
        return $this->belongsTo(Department::class);
    }
    public function states()
    {
        return $this->belongsTo(State::class);
    }

    public function designation()
    {
        return $this->hasOne(Designation::class);
    }
    public function divisions()
    {
        return $this->belongsTo(Division::class);
    }
    public function countries()
    {
        return $this->belongsTo(Country::class);
    }
    public function companies()
    {
        return $this->belongsTo(Company::class);
    }

    //    For counting the leave
    public function leave()
    {
        return $this->hasMany(Leave::class,'employee_id');
    }

    public function advance_payments()
    {
        return $this->hasMany(Advancepayment::class,'employee_id');
    }

    public function getImageAttribute(){
        if(strpos($this->picture,'http') !== false)
            return $this->picture;
        return asset("/images/$this->picture");
    }

}

