<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['title', 'short_desc', 'content', 'parent_id', 'status'];

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function subcategory()
    {
        return $this->hasMany(\App\Models\ProductCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\ProductCategory::class, 'parent_id');
    }
}
