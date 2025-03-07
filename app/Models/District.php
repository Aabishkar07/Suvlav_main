<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'district',
        'zone',
        'region',
        'province',
        'district_nepali',
    ];


    public function getprovince()
    {
        return $this->belongsTo(Province::class, 'province', 'id');
    }
}
