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

// Route::group(['middleware' => ['Auth']], function () {
Route::get('profile/passwordChange','UserController@updatePasswordView');
Route::post('profile/passwordChange','UserController@updatePassword')->name('updatePassword');
Route::get('profile/','UserController@show')->name('profile');
Route::get('profile/edit','UserController@edit');
Route::patch('profile/edit','UserController@update')->name('updateUserProfile');


Route::post('logout','LoginController@logout')->name('agency.logout');

// // });

//Authentication routes

Route::get('login','LoginController@showLoginForm')->name('agency.login');
Route::post('login','LoginController@login');

// password Reset Routes
Route::get('passwords/reset','ForgotPasswordController@showLinkRequestForm');
Route::post('passwords/email','ForgotPasswordController@sendResetLinkEmail')->name('agency.password.email');
Route::get('passwords/reset/{token}','ResetPasswordController@showResetForm');
Route::post('Passwords/rest','ResetPasswordController@reset')->name('agency.password.reset');

Route::group(['middleware' => ['Authagency:webagency']], function () {
//offers management 
Route::get('offer','OfferController@index');
Route::get('offer/show/{id}','OfferController@show')->name('agency.offer.show');
Route::get('offer/create','OfferController@create');
Route::patch('offer/edit/{id}','OfferController@update')->name('agency.offer.update');
Route::post('offer/create','OfferController@store')->name('agency.offer.create');
Route::get('offer/edit/{id}','OfferController@edit')->name('agency.offer.edit');
Route::delete('offer/delete/{id}','OfferController@destroy')->name('agency.offer.delete'); 
//profile
Route::get('profile/passwordChange','AgencyController@updatePasswordView');
Route::post('profile/passwordChange','AgencyController@updatePassword')->name('agency.update.Password');
Route::get('profile/','AgencyController@show')->name('agency.show.profile');
Route::get('profile/edit','AgencyController@edit');
Route::patch('profile/edit','AgencyController@update')->name('agency.update.profile');



});