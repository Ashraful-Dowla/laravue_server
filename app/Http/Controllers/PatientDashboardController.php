<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class PatientDashboardController extends Controller
{
    public function getPatinetInfoForDashboard(Request $request){
    	$info = DB::table('users')
    				   ->select('first_name','last_name','phone_number','image','email','birthday','address','gender')
    				   ->where('patient_id',$request->patient_id)
    				   ->get();
    	$acnt_summary = DB::table('refill_accounts')
    						  ->select('amount','refill_date','receipt_no')
    						  ->where('patient_id',$request->patient_id)
    						  ->get();
    	return response()->json(['patient_info'=>$info, 'acnt_summary'=>$acnt_summary]);
    }
    public function savePatientProfilePicture(Request $request){
    	$exploded = explode(',', $request->image);
    	$decoded = base64_decode($exploded[1]);
    	if(strpos($exploded[0], 'jpeg')){
    		$extention = 'jpg';
    	}
    	else{
    		$extention = 'png';
    	}
    	$filename = $request->id.'.'.$extention;
    	$folder = 'patientImage';
    	$path = public_path().'/'.$folder.'/'.$filename;
    	file_put_contents($path, $decoded);

    	$user = new User();
    	$patientPic = User::find($request->id);
    	$patientPic->image = $filename;
    	$patientPic->save();
    }
    public function getPatientImageForDropdown(Request $request){
        $img = DB::table('users')
                      ->select('image')
                      ->where('id',$request->id)
                      ->get();
        return response()->json($img);
    }
}
