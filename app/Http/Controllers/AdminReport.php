<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminReport extends Controller
{
	public function getData()
    {
    	$data = DB::table('report_overviews')
		    	  ->orderBy('id','desc')
		    	  ->paginate(10);

		return response()->json($data);
    }
}
