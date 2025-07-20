<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'transferById',
        'gainById',
        'transferBy',
        'gainBy',
        'status',
        'check',
    ];
}
