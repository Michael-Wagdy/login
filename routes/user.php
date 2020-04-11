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


Auth::routes();
Route::get('profile','auth\user\UserController@updatePasswordView');
Route::post('profile','auth\user\UserController@updatePassword')->name('updatePassword');
Route::post('register','auth\RegisterController@register')->name('postRegister');
?>