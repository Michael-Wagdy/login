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
Route::post('logout','AdminController@logout')->name('adminlogout');


// user management 
Route::group(['middleware' => ['Authadmin:webadmin']], function () {
Route::get('users','UserManagementController@index');
Route::get('users/create','UserManagementController@create');
Route::patch('users/edit/{id}','UserManagementController@update')->name('admin.user.update');
Route::post('users/create','UserManagementController@store')->name('registerUser');
Route::get('users/edit/{id}','UserManagementController@edit')->name('admin.user.edit');
Route::delete('users/delete/{id}','UserManagementController@delete')->name('admin.user.delete');


//agencies management 
Route::get('agenciesManagement','AgencyManagementController@index');
Route::get('agenciesManagement/create','AgencyManagementController@create');
Route::patch('agenciesManagement/edit/{id}','AgencyManagementController@update')->name('admin.agency.update');
Route::post('agenciesManagement/create','AgencyManagementController@store')->name('admin.agency.create');
Route::get('agenciesManagement/edit/{id}','AgencyManagementController@edit')->name('admin.agency.edit');
Route::delete('agenciesManagement/delete/{id}','AgencyManagementController@delete')->name('admin.agency.delete');

//offers management 
Route::get('offer','OfferManagementController@index');
Route::get('offer/show/{id}','OfferManagementController@show')->name('admin.offer.show');
Route::get('offer/create','OfferManagementController@create');
Route::patch('offer/edit/{id}','OfferManagementController@update')->name('admin.offer.update');
Route::post('offer/create','OfferManagementController@store')->name('admin.offer.create');
Route::get('offer/edit/{id}','OfferManagementController@edit')->name('admin.offer.edit');
Route::delete('offer/delete/{id}','OfferManagementController@delete')->name('admin.offer.delete');


//categories management 
Route::get('category','CategoryManagementController@index');
Route::get('category/create','CategoryManagementController@create');
Route::patch('category/edit/{id}','CategoryManagementController@update')->name('admin.category.update');
Route::post('category/create','CategoryManagementController@store')->name('admin.category.create');
Route::get('category/edit/{id}','CategoryManagementController@edit')->name('admin.category.edit');
Route::delete('category/delete/{id}','CategoryManagementController@delete')->name('admin.category.delete');
});