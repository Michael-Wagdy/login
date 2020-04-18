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

use Illuminate\Routing\RouteGroup;

Route::get('dashboard', 'AdminController@countAdmins')
->middleware('Authadmin:webadmin');
Route::get('login','AdminController@showLoginForm');
Route::post('login','AdminController@login')->name('adminLogin');
Route::get('profile','AdminController@updatePasswordView');
Route::post('profile','AdminController@updatePassword')->name('updateAdminPassword');


// user management 
Route::group(['middleware' => ['Authadmin:webadmin']], function () {
Route::get('users','UserManagementController@index');
Route::get('users/create','UserManagementController@create');
Route::patch('users/edit/{id}','UserManagementController@update')->name('admin.user.update');
Route::post('users/create','UserManagementController@store')->name('registerUser');
Route::get('users/edit/{id}','UserManagementController@edit')->name('admin.user.edit');
Route::delete('users/delete/{id}','UserManagementController@delete')->name('admin.user.delete');
});