<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'short_desc', 'content', 'slug', 'image', 'images', 'regular_price', 'sale_price', 'prod_code', 'prod_featured', 'prod_new_arrival','status','points'];

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
