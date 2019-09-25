<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestIssue extends FormRequest
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
            'options' => 'required',
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'created_by' => 'required',
            'total' => 'required',
            'id' => 'required',
            'sub_total' => 'required',
            'discount' => 'required',
            'bill_id' => 'required',
            'created_at' => 'required',
        ];
    }
}
