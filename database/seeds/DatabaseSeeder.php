<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   // protected $toTruncate=['users','blogs','permissions','permission_role','roles','user_role','blog_categories'];
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(BlogCategorySeeder::class);
        $this->call(BlogTableSeeder::class);
        $this->call(AdminassignPermission::class);
        $this->call(EmailsTemplatesSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
