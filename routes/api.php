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

Route::post('testManagement','ApiTestManagement@insertTestData');
Route::get('getTestManagementData','ApiTestManagement@getTestData');
Route::post('deleteTestManagementData','ApiTestManagement@deleteData');
Route::post('updateTestManagementData','ApiTestManagement@updateData');
//Route::get('filter','ApiTestManagement@filterData');

Route::post('addDepartments','Department@addDepartments');
Route::get('getDepartmentData','Department@getDepartmentData');
Route::post('updateDepartmentData','Department@updateData');
Route::post('deleteDepartmentData','Department@deleteData');


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

Route::get('getTestData','TestIssue@getdata');
Route::post('testIssuedData','TestIssue@insetTestIssueData');

Route::get('getBillIssuedData/{id}','ReceptionistBillIssued@getData');
Route::post('deleteBillIssuedData','ReceptionistBillIssued@deleteData');

Route::post('getOrdersData','ReceptionistOrders@getData');

Route::get('getDataUpdateTestIssue/{id}', 'ReceptionistUpdateTestIssue@getData');

Route::post('UpdateTestIssue', 'ReceptionistUpdateTestIssue@updateData');
/*========================================================================*/

/*============================ Other =====================================*/

Route::get('getDepartmentInfo','OtherController@getDepartmentInfo');
Route::post('getDoctorInfo','OtherController@getDoctorInfo');


