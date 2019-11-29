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
					    				->where('appointment_date',$appointment_date->toDateString())
					    				->get();
                                        // return $appointment_date->();

    	if($chk->isNotEmpty()){
    		return response()->json('failed',401);
    	}
    	else{
        /*=====================================================================*/
    		$query = DB::table('users')->select('id','first_name','last_name')
    							->where('patient_id',$patient_id)
    							->get();
	    	$by = $query[0]->id;
            $PT_name_combined = $query[0]->first_name.' '.$query[0]->last_name;
        /*=====================================================================*/
            $doc_name = DB::table('users')
                            ->select('first_name','last_name')
                            ->where('id',$doctor)
                            ->get();

            $doc_name_combined = $doc_name[0]->first_name.' '.$doc_name[0]->last_name;
        /*=====================================================================*/

	    	DB::table('appointments')->insert(
			    ['patient_id' => $patient_id,'patient_name' => $PT_name_combined,'doctor_id' => $doctor,'doctor_name' => $doc_name_combined,'department' => $department,'appointment_date' => $appointment_date,'status' => 'online','time' => $appointment_time,'created_at' => $dateTime,'updated_at' => $dateTime,'created_by' => $by,'updated_by' => $by]
			);
    	}
    }
    public function getAvailableDate(Request $request){
    	$receivedDepartment = $request->department;
    	$receivedDoctor = $request->doctor;
    	$receivedDate = $request->appointment_date;
    	$formatedDate = Carbon::parse($receivedDate);
    	$date = new Carbon($formatedDate);//new Carbon(Carbon::parse($request->appointment_date));
    	$day_name = $date->englishDayOfWeek;
        $onlyDate = $formatedDate->toDateString();

    	$chk = DB::table('doctor_schedules')->select('time_from','time_to')
    										  ->where('department',$receivedDepartment)
    										  ->Where('doctor_id', $receivedDoctor)
    										  ->Where('available_days', $day_name)
                                              ->distinct()
    										  ->get();

        $count = DB::table('appointments')->select('id')
                                          ->where('department',$receivedDepartment)
                                          ->where('doctor_id',$receivedDoctor)
                                          ->where('appointment_date',$onlyDate)
                                          ->count();

    	if($chk->isNotEmpty() && $count <= 2){
	    	return (['status' => '1','yes' => $chk]);
    	}
    	else{
    		$datesAvailable = [];
    		$timesFromAvailable = [];
    		$timesToAvailable = [];
            $collection = [];
    		$dateToday = /*Carbon::now()->toDateString();*/$onlyDate;
    		$avlDays = DB::table('doctor_schedules')->select('available_days','time_from','time_to')
    												->where('department',$receivedDepartment)
		    										->Where('doctor_id', $receivedDoctor)
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
		    for($i = 0; $i < $len; $i++){
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
		                        ->select('doctor_name','appointment_date','status')
		                        ->where('patient_id',$id)
		                        ->orderBy('appointment_date','desc')
                				->paginate(5);
        return response()->json($prevAppointments);
    }
    public function getAppointmentsInfo(){
        $Appointments = DB::table('appointments')
                                ->select('id','patient_name','doctor_name','department','appointment_date','status','time')
                                ->orderBy('appointment_date','desc')
                                ->paginate(5);
        return response()->json($Appointments);
    }
    public function deleteAppointment(Request $request){
        DB::table('appointments')
                ->where('id',$request->apt_id)
                ->delete();
    }
}
