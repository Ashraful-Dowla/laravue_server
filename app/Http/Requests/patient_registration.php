<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class patient_registration extends FormRequest
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
            'email' => 'required|email|unique:users',
            'userName' => 'required',
            'password' => 'required',
            'admissionDate' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postalCode' => 'required',
            'phoneNumber' => 'required',
            'nid_no' => 'required|unique:users',
            'nid_image' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'firstName' => 'First name required',
            'lastName' => 'Last name required',
            'email' => 'Email required or already taken',
            'userName' => 'Username namerequired',
            'password' => 'Password required',
            'admissionDate' => 'Admission Date required',
            'birthday' => 'Birthday required',
            'gender' => 'Gender required',
            'address' => 'Address required',
            'country' => 'Country required',
            'state' => 'State required',
            'city' => 'City required',
            'postalCode' => 'Postal code required',
            'phoneNumber' => 'Phone number required',
            'nid_no' => 'NID NO required or already taken',
            'nid_image' => 'NID image required',
            'status' => 'Status required'
        ];
    }
}
