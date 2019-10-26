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

    	DB::table('prescriptions')
    		->insert([
    			'patient_id' => $request->patient_id,
    			'patient_name' => "Ashraful Dowla",
    			'doctor_id' => $request->id,
    			'doctor_name' => 'Dr Anik Sen',
    			'department' => 'Cardiologist',
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
