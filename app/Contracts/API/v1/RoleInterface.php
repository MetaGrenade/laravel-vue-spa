<?php


namespace App\Contracts\API\v1;


interface RoleInterface
{
   public function assignRole($data);
   public function createRole($data);
   public function getRole();
   public function getRoleId($user_id);
}
