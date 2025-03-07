<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'new_name',
        'is_active',
    ];

    public function getDistrict()
    {
        return $this->hasMany(District::class, 'province', 'id');
    }
}
