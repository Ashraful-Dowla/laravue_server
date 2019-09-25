<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Collection;
use App\Http\Requests\patient_book_appointment_self;

class PatientAppoinmentController extends Controller
{
    public function patient_book_appointment(patient_book_appointment_self $request){

    	$validated = $request->validated();

    	$department = $request->department;
    	$doctor = $request->doctor;
    	$appointment_date = Carbon::parse($request->appointment_date);
    	$appointment_time = $request->appointment_time;
    	$patient_id = $request->patient_id;
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
    		$query = DB::table('users')->select('id')
    							->where('patient_id',$patient_id)
    							->first();
	    	$by = $query->id;

	    	DB::table('appointments')->insert(
			    ['patient_id' => $patient_id,'doctor_id' => $doctor,'department' => $department,'appointment_date' => $appointment_date,'status' => 'online','time' => $appointment_time,'created_at' => $dateTime,'updated_at' => $dateTime,'created_by' => $by,'updated_by' => $by]
			);
    	}
    }
    public function getAvailableDate(Request $request){
    	$receivedDepartment = $request->department;
    	$receivedDoctor = $request->doctor;
    	$receivedDate = $request->appointment_date;
    	$receivedTime = $request->appointment_time;
    	$formatedDate = Carbon::parse($receivedDate);
    	$date = new Carbon($formatedDate);
    	$day_name = $date->englishDayOfWeek;
    	$chk = DB::table('doctor_schedules')->select('time_from','time_to')
    										  ->where('department',$receivedDepartment)
    										  ->Where('doctor_id', $receivedDoctor)
    										  ->Where('available_days', $day_name)
    										  ->get();
    	if($chk->isNotEmpty()){
	    	return (['status' => '1','yes' => $chk]);
    	}
    	else{
    		$datesAvailable = [];
    		$timesFromAvailable = [];
    		$timesToAvailable = [];
    		$dateToday = Carbon::now()->toDateString();
    		$avlDays = DB::table('doctor_schedules')->select('available_days','time_from','time_to')
    												->where('department',$receivedDepartment)
		    										->Where('doctor_id', $receivedDoctor)
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

    public function patient_previous_appointments($id){
		$prevAppointments = DB::table('appointments')
		                        ->leftJoin('users', 'appointments.doctor_id', '=', 'users.id')
		                        ->select('users.first_name','users.last_name','appointments.patient_id', 'appointments.appointment_date','appointments.status')
		                        ->where('appointments.patient_id',$id)
		                        ->orderBy('appointments.appointment_date','desc')
                				->paginate(5);
        return response()->json($prevAppointments);
    }
}
