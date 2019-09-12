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
Route::get('login','AuthenticationController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*============================Admin======================================*/

Route::post('test_management','ApiTestManagement@insert_test_data');
Route::get('get_test_management_data','ApiTestManagement@get_test_data');
Route::post('delete_test_management_data','ApiTestManagement@delete_data');
Route::post('update_test_management_data','ApiTestManagement@update_data');

/*=======================================================================*/


/*============================Doctor======================================*/


/*========================================================================*/



/*==============================Patient===================================*/


/*========================================================================*/




/*============================Receptionist================================*/


/*========================================================================*/


