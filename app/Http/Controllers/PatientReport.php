<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PatientReport extends Controller
{
    public function getData($id)
    {
    	$data = DB::table('report_overviews')
		    	  ->where('patient_id',$id)
		    	  ->orderBy('id','desc')
		    	  ->paginate(10);

		return response()->json($data);
    }

    public function uploadedData($id)
    {
        $url = DB::table('report_overviews')
                 ->where('id',$id)
                 ->first();

    	$data = file_get_contents($url->report);

    	return response()->json($data);

    }
}
