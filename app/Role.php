<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_has_role', 'role_id', 'user_id');
    }

    
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_has_permission', 'role_id', 'permission_id');
    }
}
