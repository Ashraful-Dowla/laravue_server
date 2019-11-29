<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DoctorAppointmentComtroller extends Controller
{
    public function getAvailableDateforNextAppointment($date,$doctor_id,$department){
    	$doctor_id = $doctor_id;
    	$appointment_date = new Carbon(Carbon::parse($date));
    	$day_name = $appointment_date->englishDayOfWeek;
    	$department = $department;
    /*******************************************************************************************/
    	$chk = DB::table('doctor_schedules')->select('time_from','time_to')
    										  ->where('department',$department)
    										  ->Where('doctor_id', $doctor_id)
    										  ->Where('available_days', $day_name)
                                              ->distinct()
    										  ->get();
    /*******************************************************************************************/
    	if($chk->isNotEmpty()){
    		if($appointment_date->toDateString() !== Carbon::now()->toDateString()){
    			return (['status' => '1','yes' => $chk]);
    		}
    	}
    	else{
    		$datesAvailable = [];
    		$timesFromAvailable = [];
    		$timesToAvailable = [];
    		$dateToday = Carbon::now()->toDateString();
    		$avlDays = DB::table('doctor_schedules')->select('available_days','time_from','time_to')
    												->where('department',$department)
		    										->Where('doctor_id', $doctor_id)
                                                    ->distinct()
		    										->get();
		    for($k=10; $k > 0; $k--){
		    	$dateToday = date ("Y-m-d", strtotime("+1 day", strtotime($dateToday)));
		    	$nextDayName = date('l', strtotime($dateToday));
		    	foreach ($avlDays as $key) {
		    		if($key->available_days === $nextDayName){
		    			$datesAvailable[] = $dateToday;
		    			$timesFromAvailable[] = $key->time_from;
		    			$timesToAvailable[] = $key->time_to;
		    		}
		    	}
		    }
		    $len = sizeof($avlDays);
		    for($i = 0; $i<=$len; $i++){
		    	$collection[] = collect([
			    	[
			    		'date' => $datesAvailable[$i],
			    		'time_from' => $timesFromAvailable[$i],
			    		'time_to' => $timesToAvailable[$i]
			    	]
			    ]);
		    }
    		return (['status' => '0','No','dateTimeInfo' => $collection]);	
    	}
    }
    public function saveNextAppoint(Request $request){
    	$appointment_date = Carbon::parse($request->appointment_date);
    	$dateTime = Carbon::now();

    	$chk = DB::table('appointments')->select('id')
					    				->where('patient_id',$request->patient_id)
					    				->where('doctor_id',$request->doctor_id)
					    				->where('appointment_date',$appointment_date)
					    				->get();
		if($chk->isNotEmpty()){
    		return response()->json('failed',401);
    	}
    	else{
        /*=====================================================================*/
    		$query = DB::table('users')->select('first_name','last_name')
    							->where('patient_id',$request->patient_id)
    							->get();
            $PT_name_combined = $query[0]->first_name.' '.$query[0]->last_name;
        /*=====================================================================*/
            $doc_name = DB::table('users')
                            ->select('first_name','last_name')
                            ->where('id',$request->doctor_id)
                            ->get();

            $doc_name_combined = $doc_name[0]->first_name.' '.$doc_name[0]->last_name;
        /*=====================================================================*/

	    	DB::table('appointments')->insert(
			    ['patient_id' => $request->patient_id,'patient_name' => $PT_name_combined,'doctor_id' => $request->doctor_id,'doctor_name' => $doc_name_combined,'department' => $request->department,'appointment_date' => $appointment_date,'status' => 'manual','time' => $request->time,'created_at' => $dateTime,'updated_at' => $dateTime,'created_by' => $request->doctor_id,'updated_by' => $request->doctor_id]
			);
    	}
    }
    public function getPatientInfoForNextAppointment($id){
    	$info = DB::table('appointments')
    					->select('patient_id')
    					->where('doctor_id',$id)
    					->where('appointment_date',Carbon::now()->toDateString())
    					->get();
    	return response()->json(['pat_info' => $info]);
    }
}
