<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenericDataRequestValidator extends FormRequest
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
            'about'      => 'required|min:20|max:5000',
            'experience' => 'required|min:20|max:5000',
            'skills'     => 'required|min:20|max:5000',
        ];
    }
}

