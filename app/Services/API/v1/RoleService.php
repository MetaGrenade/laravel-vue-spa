<?php


namespace App\Services\API\v1;


use App\Contracts\API\v1\RoleInterface;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleInterface
{
    public function assignRole($data)
    {
        // TODO: Implement assignRole() method.
        DB::table('user_role')->where('user_id',$data['user_id'])->delete();
        $assignRole=DB::table('user_role')->insert(['user_id'=>$data['user_id'],'role_id'=>$data['role_id']]);

       return $user=User::where('id',$data['user_id'])->with('roles')->first();
    }
    public function createRole($data)
    {
        // TODO: Implement createRole() method.
        $role=new Role();
        $role->title=$data['title'];
        $role->slug=$data['slug'];
        $role->description=$data['description'];
        $role->color=$data['color'];
        $role->icon=$data['icon'];
        $role->color=$data['color'];
        $role->access_level=1;
        return $role->save() ? $role : false;

    }
    public function getRole()
    {
        // TODO: Implement getRole() method.
        return $role    =   Role::all();
    }
    public function getRoleId($user_id)
    {
        // TODO: Implement getRoleId() method.
        return DB::table('user_role')->where('user_id',$user_id)->pluck('role_id')->toArray();
    }

}
