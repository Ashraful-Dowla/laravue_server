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
    public function getPrescriptionInfo(Request $request){
        $info = DB::table('prescriptions')
                    ->select('prescription')
                    ->where('doctor_id',$request->dr_id)
                    ->where('patient_id',$request->pt_id)
                    ->orderBy('prescription_date','desc')
                    ->first();
        return response()->json(['prescription' => $info]);
    }
    public function saveAppointmentInfo(Request $request){
        $pt = DB::table('users')
                    ->select('first_name','last_name')
                    ->where('patient_id',$request->pt_id)
                    ->get();
        $dr = DB::table('users')
                    ->select('first_name','last_name','department')
                    ->where('doctor_id',$request->dr_id)
                    ->get();
                    // return ['pt'=>$pt,'dr'=>$dr,'id_dr'=>$request->dr_id,'id_pt'=>$request->pt_id];
        $date = Carbon::now()->toDateString();
        DB::table('prescriptions')
            ->insert([
                'patient_id' => $request->pt_id,
                'patient_name' => $pt[0]->first_name.' '.$pt[0]->last_name,
                'doctor_id' => $request->dr_id,
                'doctor_name' => $dr[0]->first_name.' '.$dr[0]->last_name,
                'department' => $dr[0]->department,
                'prescription' => $request->pres,
                'prescription_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
                'created_by' => $request->dr_id,
                'updated_by' => $request->dr_id,
            ]);
    }
}
