<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class visit_history extends Controller
{
    public function patient_visit_history($id){
    	$visitHistory = DB::table('visit_histories')
    						->select('*')
    						->where('patient_id','=',$id)
    						->orderBy('last_visit','desc')
                			->paginate(5);
        return response()->json($visitHistory);
    }
    public function prescription_view ($patient_id) {
    	$prescription_view = DB::table('prescriptions')->select('patient_id','patient_name','doctor_name','department','prescription_date','prescription')
    							->where('patient_id',$patient_id)
    							->orderBy('prescription_date','desc')
    							->paginate(5);
    	return response()->json($prescription_view);
    	// return($id);
    }

}
