<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'patient_first'=>'',
            'patient_last'=>'',
            'patient_date'=>'',
            'race_info'=>'',
            'preferred_lang'=>'',
            'education_info'=>'',
            'occupation_info'=>'',
            'income_info'=>'',
            'sex_info'=>'',
            'year_info'=>'',
            'age_info'=>'',
            'marital_info'=>'',
            'ethnicity_info'=>'',
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
                'patient_first.required' => 'First Name Required',
                'patient_last.required' => 'Last Name Required',
                'patient_date.required' => 'Patient Date Required',
                'race_info.required' => 'Race Required',
                'preferred_lang.required' => 'Preferred Language Required',
                'education_info.required' => 'Education Required',
                'occupation_info.required' => 'Occupation Required',
                'income_info.required' => 'Income Required',
                'sex_info.required' => 'Gender Required',
                'year_info.required' => 'Year Required',
                'age_info.required' => 'Age Required',
//                'marital_info.required' => 'Marital Status Required',
                'ethnicity_info.required' => 'Ethnicity Required',
            ];
    }
}
