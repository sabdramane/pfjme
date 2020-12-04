<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreModificationRequest extends FormRequest
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
            'codeSouscripteur' => 'bail|required|exists:souscripteurs|min:5',
            'numCnib' => 'bail|required|exists:souscripteurs|min:5',
        ];
    }
}
