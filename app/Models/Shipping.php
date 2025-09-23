<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        "member_id",
        "guest_id",
        "order_id",
        "fullname",
        "mobile",
        "email",
        "province",
        "district_id",
        "city",
        "address",
        "tole",
        "houseno",
        "gaupalika",
        "nagarpalika",
        "wardno"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function getprovince()
    {
        return $this->belongsTo(Province::class, 'province');
    }
    public function getDistrict()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function getMunicipality()
    {
        return $this->belongsTo(Municipality::class, 'nagarpalika');
    }
    public function getWard()
    {
        return $this->belongsTo(Ward::class, 'wardno');
    }
}
