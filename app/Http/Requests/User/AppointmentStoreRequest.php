<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'docname' => 'required',
            'doa' => 'required',
            'tslt' => 'required',
            'illness' => 'required|string|max:200'//
        ];
    }
}
