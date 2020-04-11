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
Route::get('dashboard', function(){
    return "test admin path";
})->middleware('Authadmin:webadmin');
Route::get('login','admin\Admin@login');
Route::post('login','admin\Admin@login_post')->name('adminLogin');
Route::get('profile','admin\Admin@updatePasswordView');
Route::post('profile','admin\Admin@updatePassword')->name('updateAdminPassword');