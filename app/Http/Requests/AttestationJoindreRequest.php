<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttestationJoindreRequest extends FormRequest
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
            'attestation' => 'bail|required|mimes:jpeg,bmp,png,pdf|max:1024',
        ];
    }
}
