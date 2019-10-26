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
Route::get('adminPrescriptionView', 'AdminPrescription@getData');
Route::get('adminBill', 'AdminBillIssued@getData');
Route::post('adminBillDelete', 'AdminBillIssued@deleteData');


/*=======================================================================*/


/*============================Doctor======================================*/

Route::post('addPrescription','DoctorPrescription@insertData');
Route::get('previousRecords/{patient_id}/{selected}','PatientPreviousRecords@getData');
Route::get('docPatientReportData/{id}','PatientPreviousRecords@getReportData');


/*========================================================================*/



/*==============================Patient===================================*/

Route::post('patientAdmission','AuthenticationController@patientAdmission');
Route::post('patient_book_appointment','PatientAppoinmentController@patient_book_appointment');
Route::post('getAvailableDate','PatientAppoinmentController@getAvailableDate');
Route::get('patient_previous_appointments/{patient_id}','PatientAppoinmentController@patient_previous_appointments');
Route::get('patient_visit_history/{patient_id}','visit_history@patient_visit_history');
Route::get('prescription_view/{patient_id}','Patient_Prescription_View@prescription_view');
Route::post('getPrescription','Patient_Prescription_View@getPrescription');

Route::get('getPatientTestIssuedData/{id}', 'PatientTestIssued@getData');

Route::get('getPatientBillIssuedData/{id}','PatientBillIssued@getData');

Route::get('getPatientBillIssuedDataPdf/{id}','PatientBillIssued@getDataPdf');

Route::get('getReport/{id}','PatientReport@getData');
Route::get('getReportData/{id}','PatientReport@uploadedData');

/*========================================================================*/




/*============================Receptionist================================*/

Route::get('getTestData','TestIssue@getdata');
Route::post('testIssuedData','TestIssue@insetTestIssueData');

Route::get('getBillIssuedData/{id}','ReceptionistBillIssued@getData');
Route::post('deleteBillIssuedData','ReceptionistBillIssued@deleteData');

Route::post('getOrdersData','ReceptionistOrders@getData');

Route::get('getDataUpdateTestIssue/{id}', 'ReceptionistUpdateTestIssue@getData');

Route::post('UpdateTestIssue', 'ReceptionistUpdateTestIssue@updateData');

Route::post('myWalletRecharge', 'MyWalletRecharge@recharge');

Route::get('getProceedToPaymentData/{bill_id}','ProceedToPayment@getData');
Route::post('paymentDataInsert','ProceedToPayment@insertData');

Route::get('getTransactionData/{user_id}', 'Transaction@getData');

Route::post('recReportUpload','ReceptionistReportUpload@insertData');
/*========================================================================*/

/*============================ Other =====================================*/

Route::get('getDepartmentInfo','OtherController@getDepartmentInfo');
Route::post('getDoctorInfo','OtherController@getDoctorInfo');


