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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/admin/login', 'Api\AdminController@login');
Route::post('/agency/login', 'Api\AgencyController@login');

Route::group(['middleware'=>'auth:api'], function(){
Route::get('/category','Api\CategoryManagementController@index');
Route::get('/category/{id}','Api\CategoryManagementController@show');
Route::post('/category/create','Api\CategoryManagementController@store');
Route::patch('/category/update/{id}','Api\CategoryManagementController@update');
Route::delete('/category/{id}','Api\CategoryManagementController@destroy');
Route::get('admin/logout', 'Api\AdminController@logout');
Route::get('admin', 'Api\AdminController@admin');
});