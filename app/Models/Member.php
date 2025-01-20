<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'affilate_code',
        'email',
        'passwrd',
        'mobileno',
        'gender',
        'state',
        'district_id',
        'address',
        'status',
        'otp',
        'googleauth_id',
        'fbauth_id',
        'total_points'

    ];
}
