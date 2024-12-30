<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
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
        'total_points'

    ];
}
