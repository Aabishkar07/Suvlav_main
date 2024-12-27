<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = [
        'search_item',
        'user_id',
        'name',
        'email',
        'phonenumber',
        'status',
        'state',
        'district',
        'gaupalika',
    ];
}
