<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::get('dashboard', 'AdminController@countAdmins')
->middleware('Authadmin:webadmin');
Route::get('login','AdminController@showLoginForm');
Route::post('login','AdminController@login')->name('adminLogin');
Route::get('profile','AdminController@updatePasswordView');
Route::post('profile','AdminController@updatePassword')->name('updateAdminPassword');