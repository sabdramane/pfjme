<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditionSouscripteurRequest extends FormRequest
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
            'dateNaissance' => 'bail|required|date|before:-14 years',
            'numCnib' => 'bail|required|min:5|unique:souscripteurs,numCnib,'.$this->souscripteur->id,
            'dateEtabCnib' => 'bail|required|date|before:now',
            'telephone' => 'bail|required|min:8',
            'email' => 'bail|email|max:255',
            'cni' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'diplom' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'attestatio' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
            'autreDocumen' => 'bail|mimes:jpeg,bmp,png,pdf|max:1024',
        ];
    }
}
