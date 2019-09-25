<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Patient_Prescription_View extends Controller
{
    public function prescription_view ($patient_id) {
    	$prescription_view = DB::table('prescriptions')->select('id','patient_id','patient_name','doctor_name','department','prescription_date')
    							->where('patient_id',$patient_id)
    							->orderBy('prescription_date','desc')
    							->paginate(5);
    	return response()->json($prescription_view);
    	// return($id);
    }
    public function getPrescription(Request $request){
    	$prescription_view = DB::table('prescriptions')->select('prescription')
    							->where('id',$request->rowid)
    							->get();
    	return response()->json(['prescription' => $prescription_view]);
    }
}
