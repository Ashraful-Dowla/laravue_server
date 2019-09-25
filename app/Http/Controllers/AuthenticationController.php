<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\patient_registration;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\GmailExam;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function patientAdmission(patient_registration $request){
    	$validated = $request->validated();

    	$firstName = $request ->firstName;
		$lastName = $request ->lastName;
		$email = $request ->email;
		$userName = $request ->userName;
		$password = bcrypt($request ->password);
		$admissionDate = $request ->admissionDate;
		$birthday = $request ->birthday;
		$admissionDate_formated = Carbon::parse($admissionDate);
		$birthday_formated = Carbon::parse($birthday);
		$gender = $request ->gender;
		$address = $request ->address;
		$country = $request ->country;
		$state = $request ->state;
		$city = $request ->city;
		$postalCode = $request ->postalCode;
		$phoneNumber = $request ->phoneNumber;
		$nid_no = $request ->nid_no;
		$nid_image = $request->nid_image;
		$status = $request ->status;
		$date = Carbon::now()->toDateTimeString();
		$randomString = Str::random(32);

		Mail::raw('echo"<a href="http://localhost:8080/emailConfirmation/'.$email.'/'.$randomString.'">Click Here</a>"', function ($message) use ($email,$randomString){
		    $message->to($email);
		});

		DB::table('users')->insert(
		    ['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email,'userName' => $userName,'password' => $password,'joining_date' => $admissionDate_formated,'birthday' => $birthday_formated,'gender' => $gender,'address' => $address,'country' => $country,'state' => $state,'city' => $city,'postal_code' => $postalCode,'phone_number' => $phoneNumber,'image' => null,'department' => null,'short_biography' => null,'doctor_id' => null,'receptionist_id' => null,'admin_id' => null,'nid_no' => $nid_no,'nid_image' => $nid_image,'status' => $status,'role' => 4,'email_verified_at' => NULL,'remember_token' => NULL,'remember_token' => $randomString,'created_at' => $date,'updated_at' => $date,'created_by' => '1','updated_by' => '1']
		);

		$lastID = DB::getPdo()->lastInsertId();
		$year = Carbon::now()->year;
		$patient_id = "PT-" . $lastID . rand() . $year;
		DB::table('users')
              ->where('id', $lastID)
              ->update(['patient_id' => $patient_id,'created_by' => $lastID,'updated_by' => $lastID]);
    }
    public function crosscheck (Request $request) {
    	$token = $request->token;
        $email = $request->email;

        //$results = DB::select('select email,remember_token  from users where email = ?', [$email]);
        $query = DB::table('users')->where('email',$email)->first();

        if($query->email_verified_at != NULL){
            return (['crosscheck' => 'verified']);
        }
        else if($query->remember_token == $token && $query->email_verified_at == NULL){

            $date = Carbon::now()->toDateTimeString();
            DB::table('users')->where('email',$email)->update(array('email_verified_at' => $date));
            return (['crosscheck' => 'true']);

        }
        else{
            return (['crosscheck' => 'invalid']); 
        }
    }
}
