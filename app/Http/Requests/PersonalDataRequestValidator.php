<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequestValidator extends FormRequest
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
            'name'      => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'address'   => 'required|min:10|max:300',
            'phone'     => 'required|min:100|max:99999999999999999|numeric',
            'email'     => 'required|email:rfc,dns',
        ];
    }
}
