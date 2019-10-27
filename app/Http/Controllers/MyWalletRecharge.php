<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use DB;
use App\Http\Requests\WalletRecharge;
use Carbon\Carbon;

class MyWalletRecharge extends Controller
{
    public function recharge(WalletRecharge $request)
    {
    	$validated = $request->validated();

    	$time = Carbon::now()->toDateTimeString();

    	$chk = DB::table('wallet_recharges')
    			 ->where('user_id',$request->user_id)
    			 ->exists();

    	if(!$chk)
    	{
    		$current_amount = 0;
    	
    		$total = $current_amount + $request->recharge_amount;

    		DB::table('wallet_recharges')
    			->insert([
    				'user_id' => $request->user_id,
    				'recharge_amount' => $request->recharge_amount,
    				'total_amount' => $total,
    				'created_by' => $request->id,
    				'updated_by' => $request->id,
    				'created_at' => $time,
    				'updated_at' => $time,
    			]);

    	}else{

    		$data = DB::table('wallet_recharges')
    							->where('user_id', $request->user_id)
    							->first();

   			$current_amount = $data->total_amount;
    							
    		$total = $current_amount + $request->recharge_amount;

    		DB::table('wallet_recharges')
    		  ->where('user_id', $request->user_id)
    		  ->update([
    		  		'recharge_amount' => $request->recharge_amount,
    				'total_amount' => $total,
    				'updated_by' => $request->id,
    				'updated_at' => $time,
    		  ]);
    	}

    	
    	// $recharge_amount = (string)($request->recharge_amount);
    	// $total = (string)($total);
    	// $user_id = (string)($request->user_id);



    	//$msg = 'Your account ' . $user_id . ' has been credited with BDT ' . $recharge_amount . ' on ' . $time . '.Account balance is BDT ' . $total . '.' ;

       	
  //   	Nexmo::message()->send([
		//     'to'   => '8801865229742',
		//     'from' => '8801927065448',
		//     'text' => $msg
		// ]);

       return response()->json([
       		'messaage' => 'Successful'
       ]);

    }
}
