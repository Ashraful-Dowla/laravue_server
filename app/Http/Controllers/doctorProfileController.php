<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class doctorProfileController extends Controller
{
    public function getDoctorInfoForProfile(Request $request){
    	$info = DB::table('users')
    			->select('first_name','last_name','department','phone_number','image','email','birthday','address','gender')
    			->where('id',$request->id)
    			->get();
    	$edu_info = DB::table('doctor_educational_infos')
    						->select('id','institution','degree','year_from','year_to','result')
    						->where('doctor_id',$request->doctor_id)
    						->get();
    	$exp_info = DB::table('doctor_experience_tbls')
    						->select('id','institution','position','year_from','year_to')
    						->where('doctor_id',$request->doctor_id)
    						->get();
    	$speciality_info = DB::table('doctor_specilities')
    							  ->select('speciality')
    							  ->where('doctor_id',$request->doctor_id)
    							  ->get();
    	return response()->json(['doctor_info' => $info,'edu_info' => $edu_info,'exp_info' => $exp_info,'sp_info' => $speciality_info]);
    }
    public function saveDoctorEducationalInfo(Request $request){
    	$date = Carbon::now();
    	$year_from = Carbon::parse($request->year_from);
    	$year_from = $year_from->toDateString();
    	$year_to = Carbon::parse($request->year_to);
    	$year_to = $year_to->toDateString();
    	DB::table('doctor_educational_infos')
    			->insert(['doctor_id' => $request->doctor_id,'institution' => $request->institution,'degree' => $request->degree,'year_from' => $year_from,'year_to' => $year_to,'result' => $request->result,'created_at' => $date,'updated_at' => $date,'created_by' => $request->id,'updated_by' => $request->id,]);
    }
    public function saveDoctorWorkingExperience(Request $request){
    	$date = Carbon::now();
    	$year_from = Carbon::parse($request->year_from);
    	$year_from = $year_from->toDateString();
    	$year_to = Carbon::parse($request->year_to);
    	$year_to = $year_to->toDateString();
    	DB::table('doctor_experience_tbls')
    			->insert(['doctor_id' => $request->doctor_id,'institution' => $request->institution,'position' => $request->position,'year_from' => $year_from,'year_to' => $year_to,'created_at' => $date,'updated_at' => $date,'created_by' => $request->id,'updated_by' => $request->id,]);
    }
    public function saveDoctorSpecility(Request $request){
    	$date = Carbon::now();
    	DB::table('doctor_specilities')
    			->insert(['doctor_id' => $request->doctor_id,'speciality' => $request->speciality,'created_at' => $date,'updated_at' => $date,'created_by' => $request->id,'updated_by' => $request->id]);
    }
    public function updateDoctorEduData(Request $request){
    	$date = Carbon::now();
    	$year_from = Carbon::parse($request->year_from);
    	$year_from = $year_from->toDateString();
    	$year_to = Carbon::parse($request->year_to);
    	$year_to = $year_to->toDateString();
    	DB::table('doctor_educational_infos')
    			->where('id',$request->rowId)
    			->update(['institution' => $request->institution,'degree' => $request->degree,'year_from' => $year_from,'year_to' => $year_to,'result' => $request->result,'updated_at' => $date,'updated_by' => $request->doctor_id]);
    }
    public function updateDoctorExpData(Request $request){
    	$date = Carbon::now();
    	$year_from = Carbon::parse($request->year_from);
    	$year_from = $year_from->toDateString();
    	$year_to = Carbon::parse($request->year_to);
    	$year_to = $year_to->toDateString();
    	DB::table('doctor_experience_tbls')
    			->where('id',$request->rowId)
    			->update(['institution' => $request->institution,'position' => $request->position,'year_from' => $year_from,'year_to' => $year_to,'updated_at' => $date,'updated_by' => $request->doctor_id,]);
    }
    public function updateDoctorGeneralData(Request $request){
    	DB::table('users')
    			->where('id',$request->doctor_id)
    			->update(['phone_number' => $request->phone, 'email' => $request->email, 'address' => $request->address]);
    }
}
