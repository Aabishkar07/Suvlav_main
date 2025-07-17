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
        'share_status',
        'status',
        'otp',
        'googleauth_id',
        'fbauth_id',
        'unique_id',
        'total_points'

    ];
}
