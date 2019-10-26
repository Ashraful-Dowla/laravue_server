<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Transaction extends Controller
{
    public function getData($user_id)
    {
    	$data = DB::table('payment_sections')
    			  ->where('created_by', $user_id)
    			  ->orderBy('id','desc')
    			  ->paginate(5);

        return response()->json($data);
    }
}
