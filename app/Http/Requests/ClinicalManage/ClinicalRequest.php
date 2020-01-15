<?php

namespace App\Http\Requests\ClinicalManage;

use Illuminate\Foundation\Http\FormRequest;

class ClinicalRequest extends FormRequest
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
            'medical_history'=>'required',
            'lab_results'=>'required',
            'lab_date'=>'',
            'medications'=>'required',
            'inc_criteria'=>'',
            'exc_criteria'=>'',
            'placebo'=>'',
            'image_name' => '',
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
                'medical_history.required' => 'Medical History Required',
                'lab_results.required' => 'Lab Results Required',
                'lab_date.required' => 'Lab Date Required',
                'medications.required' => 'Medications Required',
                'inc_criteria.required' => 'Inclusion Criteria Required',
                'exc_criteria.required' => 'Exclusion Criteria Required',
                'placebo.required' => 'Placebo Required',
            ];
    }
}
