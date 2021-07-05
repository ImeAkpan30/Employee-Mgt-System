<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'leave_type',
        'date_from',
        'date_to',
        'days',
        'reason',
        'reference_no'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved',true);
    }
}
