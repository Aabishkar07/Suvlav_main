<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'province',
        'district',
    ];
    public function getprovince()
    {
        return $this->belongsTo(Province::class, 'province', 'id');
    }
    public function getdistrict()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }
}
