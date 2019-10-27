<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function getInfoForAdminDashboard(){
    	$doc = DB::table('users')
    					->select('id')
    					->where('role',2)
    					->count();
    	$pat = DB::table('users')
    					->select('id')
    					->where('role',4)
    					->count();
    	$rec = DB::table('users')
    					->select('id')
    					->where('role',3)
    					->count();
    	$appointmentInfo = DB::table('appointments')
    					->select('department','patient_name','doctor_name','appointment_date','time')
    					->where('appointment_date', '>=', Carbon::now()->toDateString())
    					->orderBy('appointment_date','asc')
    					->paginate(5);
    	$appointmentNumber = DB::table('appointments')
    					->select('appointment_date')
    					->where('appointment_date', '>=', Carbon::now()->toDateString())
    					->count();
    	$doctor_list = DB::table('users')
    					->select('first_name','last_name','department','phone_number')
    					->where('role',2)
    					->get();
    	$new_patient = DB::table('users')
    					->select('first_name','last_name','email','phone_number')
    					->where('role',4)
    					->orderBy('joining_date','desc')
    					->paginate(4);

    	return response()->json(['dashBoardDocInfo' => $doc,'dashBoardPatInfo' => $pat,'dashBoardRecInfo' => $rec,'dashBoardAppInfo' => $appointmentInfo, 'dashBoardDoctorListInfo' => $doctor_list,'new_patient' => $new_patient, 'numberOfAppointment' => $appointmentNumber]);
    }
}
