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


Route::get('profile','UserController@updatePasswordView');
Route::post('profile','UserController@updatePassword')->name('updatePassword');


//Authentication routes
Route::get('login','LoginController@showLoginForm')->name('login');
Route::post('login','LoginController@login');
Route::post('logout','LoginController@logout')->name('logout');


// Registration routes
Route::post('register','RegisterController@register')->name('postRegister');
Route::get('register','RegisterController@register');

//password Reset Routes
Route::get('passwords/reset','ForgotPasswordController@showLinkRequestForm');
Route::post('passwords/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('passwords/reset/{token}','ResetPasswordController@showResetForm');
Route::post('Passwords/rest','ResetPasswordController@reset')->name('password.reset');