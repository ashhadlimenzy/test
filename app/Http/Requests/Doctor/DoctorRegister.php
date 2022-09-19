<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class DoctorRegister extends FormRequest
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
            'fname' => ['required', 'string', 'max:255'],
            'lname'=>'required|min:1|max:200',
            'address' => ['required', 'string', 'max:300'],
            'phno'=>['required','digits_between:10,13'],
            'expertise' => ['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', Rule::unique('doctors')->ignore($this->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed']
            //
        ];
    }
}
