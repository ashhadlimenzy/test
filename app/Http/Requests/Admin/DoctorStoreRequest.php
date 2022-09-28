<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
{
    /**
     * Determine if the doctor is authorized to make this request.
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
            'first_name' => 'required|string|max:200',
            'last_name' => 'nullable|string|max:200',
            'address' => 'required|string|max:200',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:doctors',
            'expertise' => 'required|string|max:200',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:8|confirmed'
        ];
    }
}
