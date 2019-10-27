<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Collection;
use App\Http\Requests\patient_book_appointment_self;

class PatientAppointmentEditController extends Controller
{
    public function initiateAppointmentsInfo(Request $request){
    	$rowDetails = DB::table('appointments')
    						->select('department','doctor_id','appointment_date','time')
    						->where('id',$request->apt_id)
    						->get();
    	return response()->json(['rowDetails' => $rowDetails]);
    }
    public function edit_appointment(Request $request){
    	$department = $request->department;
    	$doctor = $request->doctor;
    	$appointment_date = Carbon::parse($request->appointment_date);
    	$appointment_time = $request->appointment_time;
    	$rowID = $request->rowID;
    	$AD_id = $request->AD_id;
    	$dateTime = Carbon::now();
        /*=====================================================================*/
            $doc_name = DB::table('users')
                            ->select('first_name','last_name')
                            ->where('id',$doctor)
                            ->get();

            $doc_name_combined = $doc_name[0]->first_name.' '.$doc_name[0]->last_name;
        /*=====================================================================*/

			DB::table('appointments')
					->where('id',$rowID)
					->update(['doctor_id' => $doctor,'doctor_name' => $doc_name_combined,'department' => $department,'appointment_date' => $appointment_date,'time' => $appointment_time,'updated_at' => $dateTime,'updated_by' => $AD_id]);
    }
}
