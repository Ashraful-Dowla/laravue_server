<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\receptionist_requests;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\GmailExam;
use Illuminate\Support\Str;
class receptionist_info extends Controller
{
    public function registerReceptionist(receptionist_requests $request){

    	$validated = $request->validated();

    	$firstName = $request->firstName;
		$lastName = $request->lastName;
		$username = $request->username;
		$email = $request->email;
		$password = bcrypt($request->password);
		$joiningDate = Carbon::parse($request->joiningDate);
		$birthday = Carbon::parse($request->birthday);
		$nidNo = $request->nid_no;
		$nidImage = 'nid_image';
		$gender = $request->gender;
		$address = $request->address;
		$country = $request->country;
		$state = $request->state;
		$city = $request->city;
		$postalCode = $request->postalCode;
		$phoneNo = $request->phoneNo;
		$image = 'image';
		$status = $request->status;
		$date = Carbon::now()->toDateTimeString();
		$randomString = Str::random(32);

		Mail::raw('echo"<a href="http://localhost:8080/emailConfirmation/'.$email.'/'.$randomString.'">Click Here</a>"', function ($message) use ($email,$randomString){
		    $message->to($email);
		});

		DB::table('users')->insert(
		    ['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email,'userName' => $username,'password' => $password,'joining_date' => $joiningDate,'birthday' => $birthday,'gender' => $gender,'address' => $address,'country' => $country,'state' => $state,'city' => $city,'postal_code' => $postalCode,'phone_number' => $phoneNo,'image' => $image,'receptionist_id' => null,'admin_id' => null,'patient_id' => null,'nid_no' => $nidNo,'nid_image' => $nidImage,'status' => $status,'role' => 3,'email_verified_at' => NULL,'remember_token' => NULL,'remember_token' => $randomString,'created_at' => $date,'updated_at' => $date,'created_by' => '1','updated_by' => '1']
		);

		$lastID = DB::getPdo()->lastInsertId();
		$year = Carbon::now()->year;
		$receptionist_id = "REC-" . $lastID . rand() . $year;
        /*========================================================================*/
        $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if(strpos($exploded[0], 'jpeg')){
                $extention = 'jpg';
            }
            else{
                $extention = 'png';
            }
            $filenameImg = $lastID.'.'.$extention;
            $folder = 'receptionistImage';
            $path = public_path().'/'.$folder.'/'.$filenameImg;
            file_put_contents($path, $decoded);
        /*==========================================================================*/
            $exploded = explode(',', $request->nidImage);
            $decoded = base64_decode($exploded[1]);
            if(strpos($exploded[0], 'jpeg')){
                $extention = 'jpg';
            }
            else{
                $extention = 'png';
            }
            $filenameNID = $lastID.'_NID'.'.'.$extention;
            $folder = 'receptionistNidImageFolder';
            $path = public_path().'/'.$folder.'/'.$filenameImg;
            file_put_contents($path, $decoded);
        /*========================================================================*/
		DB::table('users')
              ->where('id', $lastID)
              ->update(['receptionist_id' => $receptionist_id,'image' => $filenameImg,'nid_image' => $filenameNID,'created_by' => $request->AD_id,'updated_by' => $request->AD_id]);
    }
    public function receptionistList() {
    	$receptionistList = DB::table('users')
    								->select('id','first_name','last_name','phone_number')
    								->where('role',3)
    								->paginate(5);
    	return response()->json($receptionistList);
    }
    public function singleReceptionistInfo(Request $request){
    	$info = DB::table('users')
    					->select('first_name','last_name','address','country','state','city','image','phone_number')
    					->where('id',$request->rowID)
    					->get();
    	return response()->json(['single_receptionist_info' => $info]);
    }
    public function initiateReceptionistInfo(Request $request){
    	$initiateInfo = DB::table('users')
    							->select('*')
    							->where('id',$request->rec_id)
    							->get();
    	return response()->json(['rec_info_edit' => $initiateInfo]);
    }
    public function saveReceptionistEdits(Request $request){
    	$date = Carbon::now();
    	DB::table('users')
    			->where('id',$request->id)
    			->update(['first_name' => $request->firstName,'last_name' => $request->lastName,'username' => $request->username,'email' => $request->email,'birthday' => $request->birthday,'address' => $request->address,'country' => $request->country,'state' => $request->state,'city' => $request->city,'postal_code' => $request->postalCode,'phone_number' => $request->phoneNumber,'status' => $request->status,'updated_at' => $date,'updated_by' => $request->AD_id]);
    }
    public function deleteReceptionist(Request $request){
    	DB::table('users')
    			->where('id',$request->rec_id)
    			->delete();
    }
    public function getReceptionistInfo(Request $request){
        $info = DB::table('users')
                       ->select('image','nid_image','first_name','last_name','email','address','gender','phone_number','birthday')
                       ->where('id',$request->rowID)
                       ->get();
        return response()->json(['recep_info' => $info]);
    }
    public function updateReceptionistGeneralInfo(Request $request){
        $dateTime = Carbon::now();
        DB::table('users')
                ->where('id',$request->rowID)
                ->update(['email' => $request->email,'address' => $request->address,'phone_number' => $request->phone,'updated_at' => $dateTime,'updated_by' => $request->rowID]);
    }
    public function getReceptionistImageForDropdown(Request $request){
        $img = DB::table('users')
                      ->select('image')
                      ->where('id',$request->id)
                      ->get();
        return response()->json($img);
    }
}
