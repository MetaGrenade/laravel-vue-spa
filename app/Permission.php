<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_has_permission', 'permission_id', 'role_id');
    }
}
