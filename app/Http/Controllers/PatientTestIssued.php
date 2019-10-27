<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PatientTestIssued extends Controller
{
    public function getData($id)
    {
    	$data = DB::table('test_issueds')
		    	  ->where('patient_id', $id)
		    	  ->paginate(10);

    	return response()->json($data);
    }
}
