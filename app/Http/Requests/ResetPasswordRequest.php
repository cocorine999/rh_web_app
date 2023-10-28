<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Password;

class ResetPasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Veuillez précisez votre ancien mot de passe',
            'password.required' => 'Veuillez précisez le nouveau mot de passe',
            //'password.confirmed' => 'Veuillez confirmer le nouveau mot de passe',
        ];
    }
}
