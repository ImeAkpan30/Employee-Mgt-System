<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'email', 'subject', 'message', 'attachment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
