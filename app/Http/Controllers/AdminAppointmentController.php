<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AdminAppointmentController extends Controller
{
    public function admin_book_appointment(Request $request){

    	$department = $request->department;
    	$doctor = $request->doctor;
    	$appointment_date = Carbon::parse($request->appointment_date);
    	$appointment_time = $request->appointment_time;
    	$patient_id = $request->patient_id;
    	$AD_id = $request->AD_id;
    	$dateTime = Carbon::now();

    	$chk = DB::table('appointments')->select('id')
					    				->where('patient_id',$patient_id)
					    				->where('doctor_id',$doctor)
					    				->where('appointment_date',$appointment_date)
					    				->get();

    	if($chk->isNotEmpty()){
    		return response()->json('failed',401);
    	}
    	else{
        /*=====================================================================*/
    		$query = DB::table('users')->select('first_name','last_name')
    							->where('patient_id',$patient_id)
    							->get();
            $PT_name_combined = $query[0]->first_name.' '.$query[0]->last_name;
        /*=====================================================================*/
            $doc_name = DB::table('users')
                            ->select('first_name','last_name')
                            ->where('id',$doctor)
                            ->get();

            $doc_name_combined = $doc_name[0]->first_name.' '.$doc_name[0]->last_name;
        /*=====================================================================*/

	    	DB::table('appointments')->insert(
			    ['patient_id' => $patient_id,'patient_name' => $PT_name_combined,'doctor_id' => $doctor,'doctor_name' => $doc_name_combined,'department' => $department,'appointment_date' => $appointment_date,'status' => 'manual','time' => $appointment_time,'created_at' => $dateTime,'updated_at' => $dateTime,'created_by' => $AD_id,'updated_by' => $AD_id]
			);
    	}
    }
}
