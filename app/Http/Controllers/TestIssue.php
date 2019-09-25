<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestIssued;
use DB;
use Carbon\Carbon;

class TestIssue extends Controller
{
    //

    public function getData()
    {	
    	$data = DB::table('test_managements')
    			   ->select('title','price')
    			   ->get();

        return response()->json($data);
    }

    public function insetTestIssueData(TestIssued $request)
    {
    	$validated = $request->validated();

    	$time = Carbon::now()->toDateTimeString();

    	DB::table('bill_issueds')
    		->insert([
    			'invoice_id' => '1',
    			'patient_id' => $request->patient_id,
    			'amount' => $request->sub_total,
                'discount' => $request->discount,
                'amount_after_discount' => $request->total,
                'due' => $request->total,
    			'issued_date' => $time,
    			'status' => '0',
    			'created_at' => $time,
    			'updated_at' => $time,
    			'created_by' => $request->id,
    			'updated_by' => $request->id
    		]);

    	$data = DB::table('bill_issueds')
    			   ->orderBy('id','desc')
    			   ->first();

        $ara = $request->options;
    	//return response()->json($ara);
    	for($i = 0 ; $i < sizeof($ara) ; $i++ ){
    		DB::table('test_issueds')
    			->insert([
    				'bill_id' => $data->id,
    				'test_name' => $ara[$i]["name"],
    				'price' => $ara[$i]["cost"],
    				'patient_id' => $request->patient_id,
    				'doctor_id' => $request->doctor_id,
    				'created_at' => $time,
    				'updated_at' => $time,
    				'created_by' => $request->id,
    				'updated_by' => $request->id 
    			]);
    	}

    	return response()->json(['message'=>'Successfully Inserted']);
    }
}
