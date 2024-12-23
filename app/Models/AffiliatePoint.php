<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliatePoint extends Model
{
    protected $fillable =
    [
        'user_id',
        'order_id',
        'points',
        'status',
    ];
}
