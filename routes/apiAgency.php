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

Route::post('/login', 'Api\AgencyController@login');

Route::group(['middleware'=>['Authagency','auth:api','scopes:agency']], function(){

Route::get('/logout', 'Api\AgencyController@logout');
Route::get('/', 'Api\AgencyController@agency');
});