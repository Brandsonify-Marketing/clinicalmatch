<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
            'firstname'=>'required',
            'lastname'=>'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => '',
            'image' => '',
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
                'firstname.required' => 'First Name Required',
                'lastname.required' => 'Last Name Required',
                'address.required' => 'Address Required',
                'contact.required' => 'Contact Number Required',
                'email.required' => 'Email Required',
            ];
    }
}
