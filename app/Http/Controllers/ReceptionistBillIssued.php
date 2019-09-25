<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ReceptionistBillIssued extends Controller
{
    public function getData($id)
    {	
    	$data = DB::table('bill_issueds')
    			  ->where('created_by',$id)
    			  ->orderBy('id','desc')
    			  ->paginate(5);

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
