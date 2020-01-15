<?php

namespace App\Http\Requests\ClinicalManage;

use Illuminate\Foundation\Http\FormRequest;

class SubRequest extends FormRequest
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
            'site_name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'mechanism'=>'required',
            'list_benefits'=>'required',
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
                'site_name.required' => 'Site Name Required',
                'address.required' => 'Address Required',
                'city.required' => 'City Required',
                'state.required' => 'State Required',
                'mechanism.required' => 'Mechanism Required',
                'list_benefits.required' => 'List Benefits Required',
            ];
    }
}
