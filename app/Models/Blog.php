<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Blog extends Model
{

    use Sluggable;
    //
    protected $fillable = [
    'title',
    'featured_image',
    'order',
    'slug',
    'description',
];

public function sluggable(): array
{
    return [
        'slug' => [
            'source' => 'title'
        ]
    ];
}

}
