<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OtherController extends Controller
{
    public function getDepartmentInfo(){
    	$departmentInfo = DB::table('departments')->select('id', 'department_name')->get();
    	return response()->json(['departmentsInfo' => $departmentInfo]);
    }
    public function getDoctorInfo(Request $request){
    	$doctorInfo = DB::table('users')->select('id', 'first_name', 'last_name')
    										  ->where('department',$request->def)
    										  ->Where('role',2)
    										  ->get();
    	return response()->json(['doctorInfo' => $doctorInfo]);
    }
}
