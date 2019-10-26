<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminBillIssued extends Controller
{
    public function getData()
    {
    	$data = DB::table('bill_issueds')
    			  ->orderBy('id','desc')
    			  ->paginate(10);

    	return response()->json($data);
    }

    public function deleteData(Request $request)
    {
    	DB::table('bill_issueds')
    		->where('id',$request->id)
    		->delete();

    	DB::table('test_issueds')
    		->where('bill_id',$request->id)
    		->delete();

    	return response()->json([
    		'message' => 'Successfully Deleted'
    	]);
    }
}
