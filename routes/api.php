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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// List Account Infos
Route::get('accountinfos','AccountInfoController@index');

// List Single Account Info
Route::get('accountinfo/{id}','AccountInfoController@show');

// Create new Account Info
Route::post('accountinfo','AccountInfoController@store');

//Update Account Info
Route::put('accountinfo','AccountInfoController@store');

//Delete Account Info
Route::delete('accountinfo/{id}','AccountInfoController@destroy');


//Register New User
Route::post('reg', 'RegistrationController@store');


//List all Service Categories
Route::get('service/categories', 'CategoryController@index');

