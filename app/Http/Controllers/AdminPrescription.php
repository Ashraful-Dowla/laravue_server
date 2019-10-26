<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminPrescription extends Controller
{
    public function getData() 
    {
    	$data = DB::table('prescriptions')->select('id','patient_id','patient_name','doctor_name','department','prescription','prescription_date')
    			  ->orderBy('prescription_date','desc')
    			  ->paginate(5);
    	
    	return response()->json($data);
    }
}
