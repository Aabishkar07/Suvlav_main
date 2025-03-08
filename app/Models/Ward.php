<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = [
        'number',
        'municipality_id',

    ];
    public function getprovince()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }
}
