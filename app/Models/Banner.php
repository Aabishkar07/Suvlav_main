<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'top_heading', 'main_heading', 'short_desc', 'image', 'btn_name', 'btn_url', 'display_option', 'status'];
}
