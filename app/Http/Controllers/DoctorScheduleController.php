<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Collection;

class DoctorScheduleController extends Controller
{
    public function getDoctorScheduleInfo(){
    	$info = DB::table('doctor_schedules')
    				->leftJoin('users', 'doctor_schedules.doctor_id','=','users.id')
    				->select('users.first_name','users.last_name','doctor_schedules.doctor_id','doctor_schedules.department','doctor_schedules.available_days','doctor_schedules.time_from','doctor_schedules.time_to','doctor_schedules.status')
    				->distinct()
    				->get();

    	$output = [];
		$doctor_id_array = [];

		foreach ($info as $values) 
		{
			$doctor_id_array [] = $values->doctor_id;
		}

		$unique_doctor_id_array = array_unique($doctor_id_array);

		foreach($info as $key => $in)
		{
			if(array_key_exists($key,$unique_doctor_id_array))
			{
			    $output[] = [
			            'department' => $in->department,
			            'doctor_id' => $in->doctor_id,
			            'first_name' => $in->first_name,
			            'last_name' => $in->last_name,
			            'status' => $in->status,
			            ];
			}
		}
		foreach($info as $in)
		{
			foreach($output as $key => $out)
		    {
			    if($out['doctor_id'] == $in->doctor_id && $out['department'] == $in->department)
			    {
			        $output[$key]['date_time'][] = ['date' =>$in->available_days,'time_from' => $in->time_from,'time_to' => $in->time_to];
			    }
		    }
		}
    	
    	return response()->json(['scheduleInfo' => $output]);
    }
    public function deleteDoctorSchedule(Request $request) {
    	DB::table('doctor_schedules')
    			->where('doctor_id',$request->doc_id)
    			->delete();
    }
    public function createSchedule(Request $request){

    	$chk = DB::table('doctor_schedules')
    				   ->select('doctor_id','department','available_days')
    				   ->where('doctor_id',$request->doctor)
    				   ->where('department',$request->department)
    				   ->where('available_days',$request->day)
    				   ->get();
    	if($chk->isNotEmpty()){
    		return response()->json('failed',401);
    	}
    	else{
    		$date = Carbon::now();
            // return $request->time_to;
	    	$time_from = $request->time_from['hh'].':'.$request->time_from['mm'].' '.$request->time_from['A'];
            // return $time_from;
	    	$time_to = $request->time_to['hh'].':'.$request->time_to['mm'].' '.$request->time_to['A'];
            // return $time_from;
	    	DB::table('doctor_schedules')
	    			->insert(['doctor_id' => $request->doctor,'department' => $request->department,'available_days' => $request->day,'time_from' => $time_from,'time_to' => $time_to,'status' => $request->status,'created_at' => $date,'updated_at' => $date,'created_by' => $request->AD_id,'updated_by' => $request->AD_id]);
    	}
    }
    public function getSingleScheduleDates(Request $request){
    	$scheduleInfo = DB::table('doctor_schedules')
    							->select('id','available_days')
    							->where('doctor_id',$request->doc_id)
    							->get();
    	return response()->json(['singleScheduleInfo' => $scheduleInfo]);
    }
    public function selecteTimeForDate(Request $request){
    	$timeinfo = DB::table('doctor_schedules')
    						->select('time_from','time_to')
    						->where('id',$request->id)
    						->get();
    	return response()->json(['timeInfo' => $timeinfo]);
    }
    public function deleteSingleScheduleInfo(Request $request){
    	DB::table('doctor_schedules')
    			->where('id',$request->sche_id)
    			->delete();
    }
    public function updateSingleScheduleInfo(Request $request){
        // return $request->time_from;
    	$time_from = $request->time_from['hh'].':'.$request->time_from['mm'].' '.$request->time_from['A'];
    	$time_to = $request->time_to['hh'].':'.$request->time_to['mm'].' '.$request->time_to['A'];

    	DB::table('doctor_schedules')
    			->where('id',$request->id)
    			->update(['time_from' => $time_from,'time_to' => $time_to]);
    	// return $request->time_from;
    }
}
