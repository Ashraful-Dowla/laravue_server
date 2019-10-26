<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProceedPayment;
use DB;
use Carbon\Carbon;

class ProceedToPayment extends Controller
{
    public function getData($bill_id)
    {
    	$data = DB::table('bill_issueds')
    	  		  ->where('id',$bill_id)
    	          ->get();
        
        return response()->json($data);
    }

    public function insertData(ProceedPayment $request)
    {
    	$validated = $request->validated();
    	
    	$time = Carbon::now()->toDateTimeString();


    	$data = DB::table('bill_issueds')
		    	 ->where('id', $request->bill_id)
		    	 ->first();

		$chk = DB::table('wallet_recharges')
    			 ->where('user_id', $data->patient_id)
    			 ->exists();

		if($request->mark == 1 && !$chk)
		{
		 	return response()->json([
		 		'message' => 'Error!'
		 	],401);
		}
		else if($request->mark == 1 && $chk)
		{
			$user_id = $data->patient_id;

			$data2 = DB::table('wallet_recharges')
						->where('id', $user_id)
						->first();

		    $current_amount = $data2->total_amount - $request->paid;

		    if( $current_amount < 0 )
		    {
			 	return response()->json([
			 		'message' => 'Error!'
			 	],401);	
		    }

			DB::table('wallet_recharges')
				->where('user_id', $user_id)
				->update([
					'total_amount' => $current_amount,
					'updated_by' => $request->id,
					'updated_at' => $time,
				]);
		}


    	DB::table('payment_sections')
    	  ->insert([
    	  	 'bill_id' => $request->bill_id,
    	  	 'paid' => $request->paid,
    	  	 'mark' => $request->mark,
    	  	 'card_number' => $request->card_number, 
    	  	 'created_at' => $time,
    	  	 'updated_at' => $time,
    	  	 'created_by' => $request->id,
    	  	 'updated_by' => $request->id,
    	  ]);

		$due = $data->due -  $request->paid;
		$status = 0;

		if($due <= 0)
		{
			$status = 1;
			$due = 0;
		}

		DB::table('bill_issueds')
			  ->where('id',$request->bill_id)
			  ->update([
			  	'due' => $due,
			  	'status' => $status,
			  	'updated_by' => $request->id,
			  	'updated_at' => $time,
			  ]);

		return response()->json([
			'message' => 'successfully done'
		]);
    }
}
