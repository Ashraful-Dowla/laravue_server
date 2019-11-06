<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecReportUpload;
use DB;
use Carbon\Carbon;

class ReceptionistReportUpload extends Controller
{
    public function insertData(RecReportUpload $request)
    {
    	$validated = $request->validated();
    	
    	$time = Carbon::now()->toDateTimeString();

        $data = DB::table('report_overviews')->latest()->first();
        // return $data;
        if($data === null){
            $filename = "P_".$request->patient_id."_R_".'1'."_".$request->report_name;
        }
        else{
            $filename = "P_".$request->patient_id."_R_".($data->id+1)."_".$request->report_name;
        }

        $path = public_path() . "/uploads/" .$filename;
        file_put_contents($path, $request->reportUrl);

        $patient_data = DB::table('users')
                          ->where('id',$request->id)
                          ->first();
        $doctor_data = DB::table('users')
                         ->where('id',$request->doctor_id)
                         ->first();

        $patient_name = $patient_data->first_name.' '.$patient_data->last_name;
        $doctor_name = $doctor_data->first_name.' '.$doctor_data->last_name;

    	DB::table('report_overviews')
    		->insert([
    			'patient_id' => $request->patient_id,
    			'patient_name' => $patient_name,
    			'doctor_id' => $request->doctor_id,
    			'doctor_name' => $doctor_name,
    			'department' => $doctor_data->department,
    			'issued_date' => $time,
    			'report' => $path,
    			'created_at' => $time,
    			'updated_at' => $time,
    			'created_by' => $request->id,
    			'updated_by' => $request->id,
    		]);

        return response()->json([
        	'message' => 'Successfully Inserted',
        ]);


    }
}
