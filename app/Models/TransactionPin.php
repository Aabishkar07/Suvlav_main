<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionPin extends Model
{
    protected $fillable = [
        'user_id',
        'pin',
        'status'
    ];
}
