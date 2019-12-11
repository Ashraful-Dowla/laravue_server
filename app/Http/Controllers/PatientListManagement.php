<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class PatientListManagement extends Controller
{
    public function getTodayPatientList($id){
    	$info = DB::table('appointments')
    					->leftJoin('users','users.patient_id','=','appointments.patient_id')
    					->select('appointments.id','appointments.patient_id','appointments.patient_name','users.phone_number','appointments.status','appointments.doctor_id','appointments.appointment_date')
    					->where('appointments.doctor_id',$id)
    					->where('appointments.appointment_date','=',Carbon::now()->toDateString())
    					->paginate(5);
                        // return Carbon::now()->toDateString();
    	return response()->json($info);
    }
    public function getAllPatientList($id){
    	$info = DB::table('appointments')
    					->leftJoin('users','users.patient_id','=','appointments.patient_id')
    					->select('appointments.patient_id','appointments.patient_name','users.phone_number','appointments.status','appointments.doctor_id')
    					->where('appointments.doctor_id',$id)
    					->paginate(5);
    	return response()->json($info);
    }
    public function getSinglePatientInfo(Request $request){
    	$info = DB::table('users')
    					->select('first_name','last_name','birthday','gender','address','phone_number')
    					->where('patient_id',$request->patient_id)
    					->get();
    	return response()->json(['patient_info' => $info]);
    }
}
