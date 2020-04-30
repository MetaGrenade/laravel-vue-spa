<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'role' => 'super-admin',
            'password' => bcrypt('secret'),
        ]);

        
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('secret'),
        ]);

        
        DB::table('users')->insert([
            'name' => 'Moderator',
            'email' => 'moderator@moderator.com',
            'role' => 'moderator',
            'password' => bcrypt('secret'),
        ]);

        
        DB::table('users')->insert([
            'name' => 'VIP',
            'email' => 'vip@vip.com',
            'role' => 'vip',
            'password' => bcrypt('password'),
        ]);

        
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'verified@user.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        
        DB::table('users')->insert([
            'name' => 'Unverified User',
            'email' => 'unverified@user.com',
            'role' => 'unverified-user',
            'password' => bcrypt('password'),
        ]);
    }
}
