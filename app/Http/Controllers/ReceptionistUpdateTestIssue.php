<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateTestIssue;
use DB;
use Carbon\Carbon;

class ReceptionistUpdateTestIssue extends Controller
{
    public function getData($id)
    {
    	$data = DB::table('test_issueds')
    			   ->where('bill_id',$id)
    			   ->get();

    	$data2 = DB::table('bill_issueds')
    				->where('id',$id)
    				->get();

        return response()->json([
        	'data' => $data,
        	'data2' => $data2,
        ]);
    }

    public function updateData(UpdateTestIssue $request)
    {
    	$validated = $request->validated();

    	$time = Carbon::now()->toDateTimeString();


    	DB::table('bill_issueds')
    		->where('id',$request->bill_id)
    		->update([
    			'invoice_id' => '1',
    			'patient_id' => $request->patient_id,
    			'amount' => $request->sub_total,
                'discount' => $request->discount,
                'amount_after_discount' => $request->total,
                'due' => $request->total,
    			'issued_date' => $time,
    			'status' => '0',
    			'updated_at' => $time,
    			'updated_by' => $request->id
    		]);

    	
    	DB::table('test_issueds')
    		->where('bill_id',$request->bill_id)
    		->delete();
    	

    	$ara = $request->options;
            	
    	for($i = 0 ; $i < sizeof($ara) ; $i++ ){
    		DB::table('test_issueds')
    			->insert([
    				'bill_id' => $request->bill_id,
    				'test_name' => $ara[$i]["name"],
    				'price' => $ara[$i]["cost"],
    				'patient_id' => $request->patient_id,
    				'doctor_id' => $request->doctor_id,
    				'created_at' => $request->created_at,
    				'updated_at' => $time,
    				'created_by' => $request->created_by,
    				'updated_by' => $request->id 
    			]);
    	}

    	return response()->json(['message'=>'Successfully Inserted']);
    }
}
