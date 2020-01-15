<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'name'=>'required',
            'account_number'=>'required',
            'routing_number'=>'required',
            'location'=>'required',
            'account_type'=>'required',
            'account_info'=>'required',
            'status'=>'required',
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
                'name.required' => 'Name Required',
                'account_number.required' => 'Account Number Required',
                'routing_number.required' => 'Routing Information Required',
                'location.required' => 'Location Required',
                'account_type.required' => 'Account Type Required',
                'account_info.required' => 'Account Information Required',
                'status.required' => 'Status Required',
            ];
    }
}
