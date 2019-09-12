<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestManagementUpdate extends FormRequest
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
            'name' => 'required',
            'test_price' => 'required',
            'updated_by' => 'required',
            'update_id' => 'required',
        ];
    }
}
