<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PatientPreviousRecords extends Controller
{
    public function getData($patient_id,$selected)
    {	
    	$data = "";

    	if($selected == 1)
    	{
    		$data = DB::table('prescriptions')
    				  ->select('patient_id','patient_name','prescription','created_at')
    				  ->where('patient_id',$patient_id)
    				  ->orderBy('created_at','desc')
    				  ->paginate(5);
    	}
    	else
    	{
    		$data = DB::table('report_overviews')
    				  ->where('patient_id',$patient_id)
    				  ->orderBy('created_at','desc')
    				  ->paginate(5);	
    	}

    	return response()->json($data);
    }

    public function getReportData($id)
    {
        $url = DB::table('report_overviews')
                 ->where('id',$id)
                 ->first();

        $data = file_get_contents($url->report);

        return response()->json($data);

    }
}
