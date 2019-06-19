<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['user_id', 'title', 'slug', 'category_id', 'published', 'image', 'intro', 'content'];

    public function setPublishedAttribute($value)
    {
        if($value === true || $value == 'true'){
            $this->attributes['published'] = 1;
        } else {
            $this->attributes['published'] = 0;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }   
}
