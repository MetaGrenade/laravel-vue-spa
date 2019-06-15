<?php

use Illuminate\Http\Request;

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
    Route::get('admin/blogs/{blog}', 'BlogController@show');
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
    Route::delete('admin/users/{user}', 'AdminUsersController@delete');
    Route::delete('admin/users/{user}/delete', 'AdminUsersController@forceDelete');
});

// USER LOGIN REQUIRED
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
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

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

//////////////////
// PUBLIC API's //
//////////////////

// Blogs
Route::get('blogs', 'BlogController@index');
Route::get('blogs/{blog}', 'BlogController@show');