<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->insert([



            [
                'title'=>'Create User',
                'slug'=>'create-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Delete User',
                'slug'=>'delete-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Edit User',
                'slug'=>'edit-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'View User',
                'slug'=>'view-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Activate User',
                'slug'=>'activate-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Force Delete User',
                'slug'=>'force-delete-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Disable User',
                'slug'=>'disable-user',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Assign role',
                'slug'=>'assign-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'View Role',
                'slug'=>'view-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Disable Role',
                'slug'=>'disable-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Delete Role',
                'slug'=>'delete-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'edit Role',
                'slug'=>'edit-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Assign Permission',
                'slug'=>'assign-permission',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Create Role',
                'slug'=>'create-role',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'View Blog',
                'slug'=>'view-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Create Blog',
                'slug'=>'create-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Publish Blogs',
                'slug'=>'publish-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Edit Blogs',
                'slug'=>'edit-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Hide Blogs',
                'slug'=>'hide-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Delete Blogs',
                'slug'=>'delete-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Force Delete Blogs',
                'slug'=>'force-delete-blog',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'View Email Templates',
                'slug'=>'view-email-template',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Create Email Templates',
                'slug'=>'create-email-template',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Edit Email Templates',
                'slug'=>'edit-email-template',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Send Bulk Emails',
                'slug'=>'send-bulk-emails',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'title'=>'Test Email Template',
                'slug'=>'test-email-template',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],

        ]);
    }
}
