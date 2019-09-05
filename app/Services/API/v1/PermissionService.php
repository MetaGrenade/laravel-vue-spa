<?php


namespace App\Services\API\v1;


use App\Contracts\API\v1\PermissionInterface;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;

class PermissionService implements PermissionInterface
{
    public function assignPermission($data)
    {
        // TODO: Implement assignPermission() method.
        DB::table('permission_role')->where('role_id',$data['role_id'])->delete();
        foreach ($data['permission_id'] as $value) {
            DB::table('permission_role')->insert(['role_id' => $data['role_id'], 'permission_id' => $value]);
        }
         $role=Role::where('id',$data['role_id'])->first();
        return $role->load('permissions');
    }
    public function getPermission()
    {
        // TODO: Implement getPermission() method.
        return $permission = Permission::all();
    }
    public function getPermissionId($role_id)
    {
        // TODO: Implement getPermissionId() method.

        return DB::table('permission_role')->where('role_id',$role_id)->pluck('permission_id')->toArray();
    }
}
