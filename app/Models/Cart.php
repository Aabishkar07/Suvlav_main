<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_id',
        'product_id',
        'quantity',
        'product_title',
        'product_image',
        'product_slug',
        'attributes',
        'user_id',
        'price'
    ];
    // protected $fillable = ['user_id', 'product_id', 'guest_id', 'price', 'product_title', 'product_image', 'quantity'];
}
