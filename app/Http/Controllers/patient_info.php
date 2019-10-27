<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class patient_info extends Controller
{
    public function initiateEditPatientInfo (Request $request) {
    	$info = DB::table('users')
    					->select('first_name','last_name','username','email','address','country','state','city','postal_code','phone_number','status')
    					->where('id',$request->pt_id)
    					->get();
    	return response()->json(['edit_patient_info' => $info]);
    }
    public function savePatientEdits(Request $request){
    	$date = Carbon::now();
    	DB::table('users')
    			->where('id',$request->id)
    			->update(['first_name' => $request->firstName,'last_name' => $request->lastName,'username' => $request->username,'email' => $request->email,'address' => $request->address,'country' => $request->country,'state' => $request->state,'city' => $request->city,'postal_code' => $request->postalCode,'phone_number' => $request->phoneNumber,'status' => $request->status,'updated_at' =>$date,'updated_by' => $request->AD_id]);

    }
}
