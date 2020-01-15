<?php

namespace App\Http\Requests\ClinicalTrails;

use Illuminate\Foundation\Http\FormRequest;

class IrbRequest extends FormRequest
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
            'study_title'=>'required',
            'private_name'=>'required',
            'site_name'=>'required',
            'phone_no'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'vol_condition'=>'required',
            'medical_condition'=>'',
            'rationale'=>'required',
            'sub_accept'=>'required',
            'drug_class'=>'required',
            'mechanism'=>'required',
            'list_benefits'=>'',
            'inc_criteria'=>'required',
            'exc_criteria'=>'required',
            'placebo'=>'required',
            // 'form_irb' => 'required|mimes:jpeg,jpg,png,bmp,gif,svg,pdf|max:2000',
            'form_irb' => '',
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
                'study_title.required' => 'Study Title Required',
                'private_name.required' => 'Private Name Required',
                'site_name.required' => 'Site Name Required',
                'phone_no.required' => 'Phone Number Required',
                'address.required' => 'Address Required',
                'city.required' => 'City Required',
                'state.required' => 'State Required',
                'vol_condition.required' => 'Open to which Required',
                'medical_condition.required' => 'Medical Condition Required',
                'rationale.required' => 'Rationale Required',
                'sub_accept.required' => 'Sub Accept Required',
                'drug_class.required' => 'Drug Class Required',
                'mechanism.required' => 'Mechanism Required',
                'list_benefits.required' => 'Benefits Required',
                'inc_criteria.required' => 'Inclusion Criteria Required',
                'exc_criteria.required' => 'Exclusion Criteria Required',
                'placebo.required' => 'Placebo Required',
                'form_irb.required' => 'Form Irb Required',
            ];
    }
}
