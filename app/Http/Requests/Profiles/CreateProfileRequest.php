<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
            'role' => '',
            'patient_first'=>'',
            'patient_last'=> '',
            'patient_date' => '',
            'address'=> '',
            'contact'=> '',
            'company_info'=> '',
            'job_title_info'=> '',
            'name_of_charity' => '',
            'bank_name' => '',
            'account_number' => '',
            'credit_card_info' => '',
            'ach_info' => '',
            'is_completed' => '',
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
                'role.required' => 'Role Required',
                'patient_first.required' => 'First Name Required',
                'patient_date.required' => 'Date Required',
                'address_info.required' => 'Address Required',
                'contact_info.required' => 'Contact Number Required',
                'company_info.required' => 'Company Number Required',
                'job_title_info.required' => 'Job Title Required',
                'name_of_charity.required' => 'Name of Charity Required',
                'bank_name.required' => 'Bank Name Required',
                'account_number.required' => 'Account Number Required',
                'credit_card_info.required' => 'Credit Card Information Required',
                'ach_info.required' => 'ACH Information Required',
            ];
    }
}
