<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminassignPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();
        DB::table('user_role')->truncate();
        DB::table('user_role')->insert(['user_id'=>1,'role_id'=>1]);
        $permission=DB::table('permissions')->get();
        foreach ($permission as $value){
            DB::table('permission_role')->insert(['role_id'=>1,'permission_id'=>$value->id]);
        }
    }
}
