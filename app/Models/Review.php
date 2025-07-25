<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'review_detail', 'user_id', 'product_id', 'rating', 'isNew', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cname()
    {
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Member::class, 'user_id');
    }

}
