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
Route::post('crosscheck','AuthenticationController@crosscheck');

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

Route::post('patientAdmission','AuthenticationController@patientAdmission');
Route::post('patient_book_appointment','PatientAppoinmentController@patient_book_appointment');
Route::post('getAvailableDate','PatientAppoinmentController@getAvailableDate');
Route::get('patient_previous_appointments/{patient_id}','PatientAppoinmentController@patient_previous_appointments');
Route::get('patient_visit_history/{patient_id}','visit_history@patient_visit_history');
Route::get('prescription_view/{patient_id}','Patient_Prescription_View@prescription_view');
Route::post('getPrescription','Patient_Prescription_View@getPrescription');

/*========================================================================*/




/*============================Receptionist================================*/


/*========================================================================*/

/*============================ Other =====================================*/

Route::get('getDepartmentInfo','OtherController@getDepartmentInfo');
Route::post('getDoctorInfo','OtherController@getDoctorInfo');


