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
Route::group(['middleware' => 'super:api'], function () {
    // super admin only routes
});

Route::group(['middleware' => 'admin:api'], function () {
    Route::get('admin/blogs', 'BlogController@adminIndex');
    Route::get('admin/blogs/{blog}', 'BlogController@show');
    Route::post('admin/blogs', 'BlogController@store');
    Route::patch('admin/blogs/{blog}', 'BlogController@update');
    Route::patch('admin/blogs/{blog}/publish', 'BlogController@publish');
    Route::patch('admin/blogs/{blog}/unpublish', 'BlogController@unpublish');
    Route::delete('admin/blogs/{blog}', 'BlogController@delete');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

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