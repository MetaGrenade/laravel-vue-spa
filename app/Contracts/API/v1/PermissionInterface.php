<?php


namespace App\Contracts\API\v1;


interface PermissionInterface
{
    public function assignPermission($data);
    public function getPermission();
    public function getPermissionId($role_id);

}
