<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id' );
    }
}
