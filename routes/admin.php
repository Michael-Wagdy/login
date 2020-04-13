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
Route::get('dashboard', 'Admin@countAdmins')
->middleware('Authadmin:webadmin');
Route::get('login','Admin@login');
Route::post('login','Admin@login_post')->name('adminLogin');
Route::get('profile','Admin@updatePasswordView');
Route::post('profile','Admin@updatePassword')->name('updateAdminPassword');