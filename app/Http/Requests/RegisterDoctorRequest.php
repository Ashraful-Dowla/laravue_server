<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'department' => 'required',
            'joiningDate' => 'required',
            'birthday' => 'required',
            'nid_no' => 'required|unique:users',
            'nidImage' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postalCode' => 'required',
            'phoneNo' => 'required',
            'image' => 'required',
            'shortBiography' => 'required',
            'status' => 'required'
        ];
    }
}
