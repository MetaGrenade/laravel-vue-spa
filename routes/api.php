<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// SUPER-ADMIN ONLY
Route::group(['middleware'=>'auth:api'],function(){
   Route::group(['prefix'=>'v1'],function(){
           Route::group(['prefix'=>'role-management'],function() {
             Route::post('assign-role','API\v1\RoleManagement@assignRole');
             Route::post('role','API\v1\RoleManagement@createRole');
             Route::get('role','API\v1\RoleManagement@index');
             Route::post('get-role-id','API\v1\RoleManagement@roleId');
           });
           Route::group(['prefix'=>'permission-management'],function() {
               Route::post('assign-permission','API\v1\PermissionManagement@assignPermission');
               Route::get('permission','API\v1\PermissionManagement@index');
               Route::post('get-permissions-id','API\v1\PermissionManagement@permissionId');
               Route::get('test','API\v1\PermissionManagement@test');
           });
           Route::group(['prefix'=>'notification-management'],function (){
               Route::get('notification','API\v1\NotificationController@index');
               Route::post('notification','API\v1\NotificationController@markAsRead');
           });
           /*Emails Templates*/
           Route::group(['prefix'=>'emails-templates'],function (){
               Route::get('emails','API\v1\EmailsController@show');
               Route::get('edit/{id}','API\v1\EmailsController@edit');
               Route::patch('update/{id}','API\v1\EmailsController@update');
               Route::post('send-bulk-emails','API\v1\EmailsController@sendBulkEmails');
               Route::post('send-test-emails','API\v1\EmailsController@sendTestEmails');
           });
       }) ;
});



Route::group(['middleware' => 'super:api'], function () {
    // roles
    Route::get('admin/roles', 'RolesController@index');
    Route::get('admin/roles/{role}', 'RolesController@show');
    Route::post('admin/roles', 'RolesController@store');
    Route::patch('admin/roles/{role}', 'RolesController@update');
    Route::delete('admin/roles/{role}', 'RolesController@delete');
    Route::delete('admin/roles/{role}/delete', 'RolesController@forceDelete');
    //blogs
    Route::delete('admin/blogs/{blog}/delete', 'BlogController@forceDelete');
    //users
    Route::delete('admin/users/{user}/delete', 'AdminUsersController@forceDelete');
});

// ADMIN ONLY
Route::group(['middleware' => 'admin:api'], function () {
    // blogs
    Route::get('admin/blogs', 'BlogController@adminIndex');
    Route::get('admin/blogs/{blog}', 'BlogController@edit');
    Route::post('admin/blogs', 'BlogController@store');
    Route::patch('admin/blogs/{blog}', 'BlogController@update');
    Route::patch('admin/blogs/{blog}/publish', 'BlogController@publish');
    Route::patch('admin/blogs/{blog}/unpublish', 'BlogController@unpublish');
    Route::delete('admin/blogs/{blog}', 'BlogController@delete');

    // users
    Route::get('admin/users', 'AdminUsersController@index');
    Route::get('admin/users/{user}', 'AdminUsersController@show');
    Route::post('admin/users', 'AdminUsersController@store');
    Route::patch('admin/users/{user}', 'AdminUsersController@update');
    Route::patch('admin/deactivate/{userId}', 'AdminUsersController@deactivateUser');
    Route::patch('admin/activate/{userId}', 'AdminUsersController@activate');
    Route::delete('admin/users/{user}', 'AdminUsersController@delete');
    Route::delete('admin/users/{user}/delete', 'AdminUsersController@forceDelete');
});

// USER LOGIN REQUIRED
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {

        return  User::with('roles.permissions')->where('id',Auth::user()->id)->first();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

// GUEST ONLY
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/verify-url/{key}', 'Auth\ResetPasswordController@vefifyUrl');
    Route::post('password/set-password', 'Auth\ResetPasswordController@setPassword');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

//////////////////
// PUBLIC API's //
//////////////////

// Blogs
Route::get('blogs/categories', 'BlogController@categories');
Route::get('blogs', 'BlogController@index');
Route::get('blogs/{blog}', 'BlogController@show');
