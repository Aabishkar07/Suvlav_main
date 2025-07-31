<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'order_details';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'quantity',
        'attributes',
        'price',
        'created_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
}
