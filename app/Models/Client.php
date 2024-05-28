<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'email',
        'otp',
    ];
}
