<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationSouscriptionRequest extends FormRequest
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
            'quittance' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'codeValidation' => 'bail|unique:souscripteurs',
            'numeroQuittance' => 'bail|unique:souscripteurs|exists:quittances',
        ];
    }
}
