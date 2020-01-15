<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalRequest extends FormRequest
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
            'job_title_info'=>'',
//            'address_info' => 'required',
//            'email' => 'required',
//            'contact_info' => 'required',
        ];
    }
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
            return [
                'job_title_info.required' => 'Job Title Required',
//                'address_info.required' => 'Address Required',
//                'email.required' => 'Email Required',
//                'contact_info.required' => 'Contact Number Required',
            ];
    }
}
