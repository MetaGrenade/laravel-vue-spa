<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'slug', 'category_id', 'published', 'image', 'intro', 'content'];
}
