<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupeRequest extends FormRequest
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
            'name' => 'required',
            'file' => 'sometimes|mimes:png,jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Veuillez saisir le nom du groupe',
            'file.sometimes' => 'Veillez selectionner une image de type png ou jpeg',
            //'password.confirmed' => 'Veuillez confirmer le nouveau mot de passe',
        ];
    }
}
