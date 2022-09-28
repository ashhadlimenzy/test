<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlotdateStoreRequest extends FormRequest
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
            'stadoa'=>'required|after:today|before_or_equal:enddoa',
            'enddoa'=>'required|after:today|after_or_equal:stadoa',
            'stattim'=>'required|before_or_equal:endtim',
            'endtim'=>'required|after_or_equal:stattim',
            'slottim'=>'required',
            
        ];
    }
}
