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

			/*******************************/
Route::post('registerDoctor','RegisterDoctor@registerDoctor');
Route::post('deleteDoctor','RegisterDoctor@deleteDoctor');
Route::post('editDoctor','RegisterDoctor@editDoctor');
			/*******************************/
Route::post('deletePatient','AuthenticationController@deletePatient');
Route::post('initiateEditPatientInfo','patient_info@initiateEditPatientInfo');
Route::post('savePatientEdits','patient_info@savePatientEdits');
			/*******************************/
Route::post('registerReceptionist','receptionist_info@registerReceptionist');
Route::get('receptionistList','receptionist_info@receptionistList');
Route::post('singleReceptionistInfo','receptionist_info@singleReceptionistInfo');
Route::post('initiateReceptionistInfo','receptionist_info@initiateReceptionistInfo');
Route::post('saveReceptionistEdits','receptionist_info@saveReceptionistEdits');
Route::post('deleteReceptionist','receptionist_info@deleteReceptionist');
			/*******************************/
Route::get('getAppointmentsInfo','PatientAppoinmentController@getAppointmentsInfo');
Route::post('deleteAppointment','PatientAppoinmentController@deleteAppointment');
Route::post('initiateAppointmentsInfo','PatientAppointmentEditController@initiateAppointmentsInfo');
Route::post('edit_appointment','PatientAppointmentEditController@edit_appointment');
Route::post('admin_book_appointment','AdminAppointmentController@admin_book_appointment');
Route::post('Limit_crossed_next_dates','AdminAppointmentController@Limit_crossed_next_dates');
			/*******************************/
Route::get('getDoctorScheduleInfo','DoctorScheduleController@getDoctorScheduleInfo');
Route::post('deleteDoctorSchedule','DoctorScheduleController@deleteDoctorSchedule');
Route::post('createSchedule','DoctorScheduleController@createSchedule');
Route::post('getSingleScheduleDates','DoctorScheduleController@getSingleScheduleDates');
Route::post('selecteTimeForDate','DoctorScheduleController@selecteTimeForDate');
Route::post('deleteSingleScheduleInfo','DoctorScheduleController@deleteSingleScheduleInfo');
Route::post('updateSingleScheduleInfo','DoctorScheduleController@updateSingleScheduleInfo');
			/******************************/
Route::get('getInfoForAdminDashboard','AdminDashboardController@getInfoForAdminDashboard');


/*=======================================================================*/


/*============================Doctor======================================*/
Route::get('getTodayPatientList/{doctor_id}','PatientListManagement@getTodayPatientList');
Route::get('getAllPatientList/{doctor_id}','PatientListManagement@getAllPatientList');
Route::post('getSinglePatientInfo','PatientListManagement@getSinglePatientInfo');
Route::get('getDepartmentwiseDoctorInfo/{dept_name}','OtherController@getDepartmentwiseDoctorInfo');
Route::get('getAvailableDateforNextAppointment/{date}/{doctor_id}/{department}','DoctorAppointmentComtroller@getAvailableDateforNextAppointment');
Route::post('saveNextAppoint','DoctorAppointmentComtroller@saveNextAppoint');
Route::get('getPatientInfoForNextAppointment/{id}','DoctorAppointmentComtroller@getPatientInfoForNextAppointment');
Route::post('getDoctorInfoForProfile','doctorProfileController@getDoctorInfoForProfile');
Route::post('saveDoctorEducationalInfo','doctorProfileController@saveDoctorEducationalInfo');
Route::post('saveDoctorWorkingExperience','doctorProfileController@saveDoctorWorkingExperience');
Route::post('saveDoctorSpecility','doctorProfileController@saveDoctorSpecility');
Route::post('updateDoctorEduData','doctorProfileController@updateDoctorEduData');
Route::post('updateDoctorExpData','doctorProfileController@updateDoctorExpData');
Route::post('updateDoctorGeneralData','doctorProfileController@updateDoctorGeneralData');

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
Route::post('getPatinetInfoForDashboard','PatientDashboardController@getPatinetInfoForDashboard');
Route::post('savePatientProfilePicture','PatientDashboardController@savePatientProfilePicture');

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


Route::post('getReceptionistInfo','receptionist_info@getReceptionistInfo');
Route::post('updateReceptionistGeneralInfo','receptionist_info@updateReceptionistGeneralInfo');

Route::post('myWalletRecharge', 'MyWalletRecharge@recharge');

Route::get('getProceedToPaymentData/{bill_id}','ProceedToPayment@getData');
Route::post('paymentDataInsert','ProceedToPayment@insertData');

Route::get('getTransactionData/{user_id}', 'Transaction@getData');

Route::post('recReportUpload','ReceptionistReportUpload@insertData');

/*========================================================================*/

/*============================ Other =====================================*/

Route::get('getDepartmentInfo','OtherController@getDepartmentInfo');
Route::post('getDoctorInfo','OtherController@getDoctorInfo');
Route::get('getDoctorsList','OtherController@getDoctorsList');
Route::post('singleDoctorInfo','OtherController@singleDoctorInfo');
Route::post('doctorInfoForEdit','OtherController@doctorInfoForEdit');
Route::get('getPatientInfo','OtherController@getPatientInfo');
Route::get('adminGetLeaveTypeInfo','OtherController@adminGetLeaveTypeInfo');
Route::post('refillAccount','OtherController@refillAccount');
Route::get('getLeaveTypeInfo','OtherController@getLeaveTypeInfo');
Route::post('addLeaveType','OtherController@addLeaveType');
Route::post('deleteLeaveType','OtherController@deleteLeaveType');
			/***************************************/
Route::post('addLeaveManually','OtherController@addLeaveManually');
Route::get('getLeaveRequests','OtherController@getLeaveRequests');
Route::post('acceptLeaveRequest','OtherController@acceptLeaveRequest');
Route::post('denyLeaveRequest','OtherController@denyLeaveRequest');
Route::post('addLeaveByDoctor','OtherController@addLeaveByDoctor');
Route::get('leaveRequestApproval/{doctor_id}','OtherController@leaveRequestApproval');
Route::post('deleteLeaveRequestApproval','OtherController@deleteLeaveRequestApproval');

