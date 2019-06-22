<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategories extends Model
{
    //
    protected $fillable = ['title', 'slug', 'published']; 

    public function blogs()
    {
        return $this->belongsToMany('App\Blog');
    }   
}
