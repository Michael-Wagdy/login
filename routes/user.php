<?php

/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'User'], function () {
Route::get('profile/passwordChange','UserController@updatePasswordView');
Route::post('profile/passwordChange','UserController@updatePassword')->name('updatePassword');
Route::get('profile/','UserController@show')->name('profile');
Route::get('profile/edit','UserController@edit');
Route::patch('profile/edit','UserController@update')->name('updateUserProfile');
Route::get('contactus','ContactUSController@create');
Route::post('contactus','ContactUSController@store')->name('user.contactus');

//home

Route::get('home', 'HomeController@index')->name('user.home');
});

//Authentication routes
Route::group(['namespace' => 'Auth\User'], function () {
Route::post('logout','LoginController@logout')->name('logout');

Route::get('login','LoginController@showLoginForm')->name('login');
Route::post('login','LoginController@login');
// Registration routes
Route::post('register','RegisterController@register')->name('postRegister');
Route::get('register','RegisterController@showRegistrationForm');

//password Reset Routes
Route::get('passwords/reset','ForgotPasswordController@showLinkRequestForm');
Route::post('passwords/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('passwords/reset/{token}','ResetPasswordController@showResetForm');
Route::post('Passwords/rest','ResetPasswordController@reset')->name('password.reset');


});