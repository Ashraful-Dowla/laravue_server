<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\refillRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
    public function getDoctorsList() {
        $doctorList = DB::table('users')
                            ->select('id','first_name','last_name','department','image','address','phone_number')
                            ->where('role',2)
                            ->paginate(5);
        return response()->json($doctorList);
    }
    public function singleDoctorInfo(Request $request) {
        $single_doctor_info = DB::table('users')
                                    ->select('*')
                                    ->where('id',$request->rowID)
                                    ->get();
        return(['single_doc_info' => $single_doctor_info]);
    }
    public function doctorInfoForEdit(Request $request) {
        $doc_info_edit =DB::table('users')
                            ->select('*')
                            ->where('id',$request->doc_id)
                            ->first();
        return response()->json(['doc_info_edit' => $doc_info_edit]);
    }
    public function getPatientInfo(){
        $patientInfo = DB::table('users')
                ->select('id','first_name','last_name','joining_date','phone_number')
                ->where('role',4)
                ->paginate(5);
        return response()->json($patientInfo);
    }
    public function refillAccount(refillRequest $request){
        
        $chk = DB::table('refill_accounts')
                        ->select('id')
                        ->where('patient_id',$request->patient_id)
                        ->get();
        if($chk->isNotEmpty()){
            return response()->json('failed',401);
        }
        else{
            $date = Carbon::now();
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $receipt_no = "RN-".$month.'-'.$year.'-'.rand();
            DB::table('refill_accounts')
                    ->insert(['patient_id' => $request->patient_id,'amount' => $request->refillAmount,'refill_date' => $date,'receipt_no' => $receipt_no,'created_at' => $date,'updated_at' => $date,'created_by' => $request->AD_id,'updated_by' => $request->AD_id]);
            }
    }
    public function getLeaveTypeInfo(){
        $info = DB::table('leave_types')
                ->select('id','leave_type')
                ->paginate(5);
        return response()->json($info);
    }
    public function addLeaveType(Request $request){

        $chk = DB::table('leave_types')
                    ->where('slug_leave_type',Str::slug($request->LeaveType,' '))
                    ->exists();
        if($chk)
        {
            return response()->json('failed',401);
        }
        
        $date = Carbon::now();
        DB::table('leave_types')
                ->insert(['leave_type' => $request->LeaveType,'slug_leave_type' => Str::slug($request->LeaveType,' '),'created_at' => $date,'updated_at' => $date,'created_by' => $request->AD_id, 'updated_by' => $request->AD_id]);
    }
    public function deleteLeaveType(Request $id){
        DB::table('leave_types')
                ->where('id',$id->rowID)
                ->delete();
    }
    public function adminGetLeaveTypeInfo(){
        $info = DB::table('leave_types')
                        ->select('leave_type')
                        ->get();
        return response()->json(['leaveTypeInfo' => $info]);
    }
    public function addLeaveManually(Request $request){
        $chk = DB::table('leave_managements')
                    ->where('department_name',$request->department)
                    ->where('doctor_id',$request->doctor_id)
                    ->where('status',0)
                    ->get();
        if($chk->isNotEmpty()){
            return response()->json('failed',401);
        }
        else{
            $date = Carbon::now();
            $date_from = Carbon::parse($request->time_from);
            $date_to = Carbon::parse($request->time_to);
            DB::table('leave_managements')
                    ->insert(['request_type' => $request->leave_type,'department_name' => $request->department,'doctor_id' => $request->doctor_id,'date_from' => $date_from,'date_to' => $date_to,'number_of_days' => $request->number_of_days,'leave_reason' => $request->leave_reason,'status' => 0,'created_at' => $date,'updated_at' => $date,'created_by' => $request->AD_id,'updated_by' => $request->AD_id]);
        }
    }
    public function getLeaveRequests(){
        $info = DB::table('leave_managements')
                        ->leftJoin('users','leave_managements.doctor_id','=','users.doctor_id')
                        ->select('users.first_name','users.last_name','leave_managements.id','leave_managements.request_type','leave_managements.department_name','leave_managements.date_from','leave_managements.date_to','leave_managements.number_of_days','leave_managements.leave_reason','leave_managements.status')
                        // ->where('leave_managements.status',0)
                        // ->where('leave_managements.status',1)
                        ->paginate(5);
        return response()->json($info);
    }
    public function acceptLeaveRequest(Request $id){
        DB::table('leave_managements')
                ->where('id',$id->id)
                ->update(['status' => 1]);
    }
    public function denyLeaveRequest(Request $request){
        DB::table('leave_managements')
                ->where('id',$request->id)
                ->update(['status'=>0]);
    }
    public function getDepartmentwiseDoctorInfo($dept_name){
        $info = DB::table('users')
                        ->select('first_name','last_name','gender','phone_number')
                        ->where('department',$dept_name)
                        ->where('role',2)
                        ->paginate(5);
        return response()->json($info);
    }
    public function addLeaveByDoctor(Request $request){
        $chk = DB::table('leave_managements')
                    ->where('department_name',$request->department)
                    ->where('doctor_id',$request->doctor_id)
                    ->exists();
        if($chk){
            return response()->json('failed',401);
        }
        else{
            $date = Carbon::now();
            $date_from = Carbon::parse($request->time_from);
            $date_to = Carbon::parse($request->time_to);
            DB::table('leave_managements')
                    ->insert(['request_type' => $request->leave_type,'department_name' => $request->department,'doctor_id' => $request->doctor_id,'date_from' => $date_from,'date_to' => $date_to,'number_of_days' => $request->number_of_days,'leave_reason' => $request->leave_reason,'status' => 0,'created_at' => $date,'updated_at' => $date,'created_by' => $request->doctor_id,'updated_by' => $request->doctor_id]);
        }
    }
    public function leaveRequestApproval($doctor_id){
        $info = DB::table('leave_managements')
                        ->select('id','request_type','date_from','date_to','number_of_days','status')
                        ->where('doctor_id',$doctor_id)
                        ->paginate(5);
        return response()->json($info);
    }
    public function deleteLeaveRequestApproval(Request $request){
        DB::table('leave_managements')
                ->where('id',$request->rowData)
                ->delete();
    }
}
