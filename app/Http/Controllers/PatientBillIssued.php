<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PatientBillIssued extends Controller
{
    public function getData($id)
    {
    	$data = DB::table('bill_issueds')
    			  ->where('patient_id',$id)
    			  ->orderBy('id','desc')
    			  ->paginate(5);

    	return response()->json($data);
    }

    public function getDataPdf($id)
    {
    	$data = DB::table('test_issueds')
    				->where('bill_id',$id)
    				->get();

    	$data2 = DB::table('bill_issueds')
    				->where('id',$id)
    				->get();

    	return response()->json([
    		'data' => $data,
    		'data2' => $data2
    	]);
    }
}
