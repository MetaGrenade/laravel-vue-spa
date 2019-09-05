<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $role = new Role();
        $role->title = 'Super Admin';
        $role->slug = 'super-admin';
        $role->icon = 'crown';
        $role->color = 'text-danger';
        $role->description = 'Reserved for Developers';
        $role->access_level = 99;
        $role->save();
        $role = new Role();
        $role->title = 'Banned';
        $role->slug = 'banned';
        $role->icon = 'ban';
        $role->color = 'text-muted';
        $role->description = 'Banned Users...';
        $role->access_level = -1;
        $role->save();
        
        $role = new Role();
        $role->title = 'Unverified User';
        $role->slug = 'unverified-user';
        $role->icon = 'user';
        $role->color = 'text-muted';
        $role->description = 'Unverified Users...';
        $role->access_level = 0;
        $role->save();
        
        $role = new Role();
        $role->title = 'User';
        $role->slug = 'user';
        $role->icon = 'user';
        $role->color = 'text-dark';
        $role->description = 'Verified Users...';
        $role->access_level = 1;
        $role->save();
        
        $role = new Role();
        $role->title = 'VIP';
        $role->slug = 'vip';
        $role->icon = 'user-plus';
        $role->color = 'text-success';
        $role->description = 'Special User Role, Reserved for ...!';
        $role->access_level = 2;
        $role->save();
        
        $role = new Role();
        $role->title = 'Partner / Sponsor';
        $role->slug = 'partner';
        $role->icon = 'handshake';
        $role->color = 'text-success';
        $role->description = 'Reserved for Partners, Sponsors & Advertisers!';
        $role->access_level = 3;
        $role->save();
        
        $role = new Role();
        $role->title = 'Writer';
        $role->slug = 'writer';
        $role->icon = 'newspaper';
        $role->color = 'text-primary';
        $role->description = 'Content Creator & Writer!';
        $role->access_level = 4;
        $role->save();
        
        $role = new Role();
        $role->title = 'Moderator';
        $role->slug = 'moderator';
        $role->icon = 'star';
        $role->color = 'text-warning';
        $role->description = 'Admin User with minimal permissions!';
        $role->access_level = 5;
        $role->save();
        
        $role = new Role();
        $role->title = 'Admin';
        $role->slug = 'admin';
        $role->icon = 'shield-alt';
        $role->color = 'text-danger';
        $role->description = 'High level administrative User!';
        $role->access_level = 6;
        $role->save();
        

    }
}
