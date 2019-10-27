<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterDoctorRequest;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\GmailExam;
use Illuminate\Support\Str;
class RegisterDoctor extends Controller
{
    public function registerDoctor (RegisterDoctorRequest $request) {
    	$validated = $request->validated();

    	$firstName = $request->firstName;
		$lastName = $request->lastName;
		$username = $request->username;
		$email = $request->email;
		$password = bcrypt($request->password);
		$department = $request->department;
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
		$shortBiography = $request->shortBiography;
		$status = $request->status;
		$date = Carbon::now()->toDateTimeString();
		$randomString = Str::random(32);

		Mail::raw('echo"<a href="http://localhost:8080/emailConfirmation/'.$email.'/'.$randomString.'">Click Here</a>"', function ($message) use ($email,$randomString){
		    $message->to($email);
		});

		DB::table('users')->insert(
		    ['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email,'userName' => $username,'password' => $password,'joining_date' => $joiningDate,'birthday' => $birthday,'gender' => $gender,'address' => $address,'country' => $country,'state' => $state,'city' => $city,'postal_code' => $postalCode,'phone_number' => $phoneNo,'image' => $image,'department' => $department,'short_biography' => $shortBiography,'receptionist_id' => null,'admin_id' => null,'patient_id' => null,'nid_no' => $nidNo,'nid_image' => $nidImage,'status' => $status,'role' => 2,'email_verified_at' => NULL,'remember_token' => NULL,'remember_token' => $randomString,'created_at' => $date,'updated_at' => $date,'created_by' => '1','updated_by' => '1']
		);

		$lastID = DB::getPdo()->lastInsertId();

		/*=========================Doctor Image Manipulation=============================*/
			$exploded = explode(',', $request->image);
	    	$decoded = base64_decode($exploded[1]);
	    	if(strpos($exploded[0], 'jpeg')){
	    		$extention = 'jpg';
	    	}
	    	else{
	    		$extention = 'png';
	    	}
	    	$filenameImg = $lastID.'.'.$extention;
	    	$folder = 'doctorImage';
	    	$path = public_path().'/'.$folder.'/'.$filenameImg;
	    	file_put_contents($path, $decoded);
    	/*==========================Doctor NID Image Manipulation============================*/
	    	$exploded = explode(',', $request->nidImage);
	    	$decoded = base64_decode($exploded[1]);
	    	if(strpos($exploded[0], 'jpeg')){
	    		$extention = 'jpg';
	    	}
	    	else{
	    		$extention = 'png';
	    	}
	    	$filenameNID = $lastID.'_NID'.'.'.$extention;
	    	$folder = 'doctorNidImageFolder';
	    	$path = public_path().'/'.$folder.'/'.$filenameNID;
	    	file_put_contents($path, $decoded);
    	/*=====================================================================================*/


    	
		$year = Carbon::now()->year;
		$doctor_id = "DR-" . $lastID . rand() . $year;
		DB::table('users')
              ->where('id', $lastID)
              ->update(['doctor_id' => $doctor_id,'image' => $filenameImg,'nid_image' => $filenameNID,'created_by' => $request->AD_id,'updated_by' => $request->AD_id]);
    }
    public function deleteDoctor (Request $request) {
    	DB::table('users')
    			->where('id',$request->dr_id)
    			->delete();
    }
    public function editDoctor(Request $request){
    	$date = Carbon::now();
    	DB::table('users')
    		->where('id',$request->id)
    		->update(['first_name' => $request->firstName,'last_name' => $request->lastName,'username' => $request->username,'email' => $request->email,'department' => $request->department,'birthday' => $request->birthday,'address' => $request->address,'country' => $request->country,'state' => $request->state,'city' => $request->city,'postal_code' => $request->postalCode,'phone_number' => $request->phoneNo,'short_biography' => $request->shortBiography,'status' => $request->status,'updated_at' => $date,'updated_by' => $request->AD_id]);
    }
}
