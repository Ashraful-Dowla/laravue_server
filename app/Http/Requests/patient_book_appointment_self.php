<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class patient_book_appointment_self extends FormRequest
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
            'department' => 'required',
            'doctor' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ];
    }
}
