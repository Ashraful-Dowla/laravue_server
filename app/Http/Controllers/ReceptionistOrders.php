<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Orders;
use DB;

class ReceptionistOrders extends Controller
{
    public function getData(Orders $request)
    {
    	$validated = $request->validated();

    	$data = DB::table('test_issueds')
    				->where('bill_id',$request->bill_id)
    				->get();

    	$data2 = DB::table('bill_issueds')
    				->where('id',$request->bill_id)
    				->get();

    	return response()->json([
    		'data' => $data,
    		'data2' => $data2
    	]);
    }
}
