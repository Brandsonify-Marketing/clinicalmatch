<?php

namespace App\Http\Requests\ClinicalTrails;

use Illuminate\Foundation\Http\FormRequest;

class NonIrbRequest extends FormRequest
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
            'private_name'=>'required',
            'site_name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'vol_condition'=>'',
            'medical_condition'=>'',
            'rationale'=>'required',
            'summary_exc_inc'=>'required',
            'participation'=>'required',
            'placebo'=>'required',
            'email' =>'required|email',
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
                'private_name.required' => 'Private Name Required',
                'site_name.required' => 'Site Name Required',
                'address.required' => 'Address Required',
                'city.required' => 'City Required',
                'state.required' => 'State Required',
                'vol_condition.required' => 'Open to which Required',
                'medical_condition.required' => 'Medical Condition Required',
                'rationale.required' => 'Rationale Required',
                'summary_exc_inc.required' => 'Summary Required',
                'participation.required' => 'Participation Required',
                'placebo.required' => 'Placebo Required',
            ];
    }
}
