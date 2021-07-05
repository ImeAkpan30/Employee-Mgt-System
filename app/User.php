<?php

namespace App;

use Cache;
use App\Mail;
use App\Leave;
use App\Company;
use App\Employee;
use App\Designation;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements BannableContract
{
    use Notifiable;
    use Bannable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'lastname', 'role', 'email', 'password', 'last_login_at',
        'last_login_ip', 'leaves_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function designation()
    {
        return $this->hasOne(Designation::class);
    }

    public function mail()
    {
        return $this->hasOne(Mail::class);
    }

    //    For counting the leave
    public function leave()
    {
        return $this->HasMAny(Leave::class,'employee_id');
    }

    public function get_UserNumber(){

        $this->db->select("count(*) as no");
        $query = $this->db->get("users");
        return $query->result();

    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
