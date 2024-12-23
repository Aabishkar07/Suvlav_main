<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['title', 'short_desc', 'content', 'slug', 'image','status'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
