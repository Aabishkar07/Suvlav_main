<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{

        protected $table = 'orders'; 


    protected $fillable = [
        'new_product_id',
        'product_name',
        'price',
        'user_id',
        'item_id',
        'attribute',
        'status',
        'points',
    ];

        public function orderDetails()
{
    return $this->hasMany(OrderDetail::class, 'order_id', 'id');
}
}
