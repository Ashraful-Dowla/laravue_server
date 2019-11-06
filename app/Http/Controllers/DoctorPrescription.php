<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\DoctorPrescriptionInsertData;
use Carbon\Carbon;

class DoctorPrescription extends Controller
{
    public function insertData(DoctorPrescriptionInsertData $request)
    {
    	$validated = $request->validated();

    	$time = Carbon::now()->toDateTimeString();

        $data = DB::table('users')
                  ->where('id',$request->patient_id)
                  ->first();

        $patient_full_name = $data->first_name.' '.$data->last_name;

        $data2 = DB::table('users')
                   ->where('id',$request->id)
                   ->first();

        $doctor_name = $data2->first_name.' '.$data2->last_name;
        $department = $data2->department;

    	DB::table('prescriptions')
    		->insert([
    			'patient_id' => $request->patient_id,
    			'patient_name' => $patient_full_name,
    			'doctor_id' => $request->id,
    			'doctor_name' => $doctor_name,
    			'department' => $department,
    			'prescription' => $request->editor_text,
    			'prescription_date' => $time,
    			'created_at' => $time,
    			'updated_at' => $time,
    			'created_by' => $request->id,
    			'updated_by' => $request->id,
    		]);

    	return response()->json([
    		'message' => 'Successfully Inserted!'
    	]);
    }
}
