<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SouscripteurRequest extends FormRequest
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
            'region' => 'bail|required|max:255',
            'province' => 'bail|required|max:255',
            'departement' => 'bail|required|max:255',
            'localite' => 'bail|required|max:255',
            'nom' => 'bail|required|max:255',
            'prenom' => 'bail|required|max:255',
           // 'dateNaissance' => 'bail|date|before:-14 years',
            //'numCnib' => 'bail|unique:souscripteurs',
            //'dateEtabCnib' => 'bail|date|before:now',
            //'telephone' => 'bail|min:8',
            'cnib' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'diplome' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'attestation' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'autreDocument' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
        ];
    }
}
