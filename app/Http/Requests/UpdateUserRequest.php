<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends FormRequest

{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'name' => 'required',
            'email'=> 'required',
            'profil' => 'required',
            'adresse' => 'required',
            'phone'=> 'required',
            'password'=> 'required',
        ];
    }

     public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'status_code' => 422,
            'message' => 'Modification echoué',
            'errorsList' => $validator->errors(),
        ], 422));
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Un nom est requis.',
            'email.required' => 'Une adresse mail est requis.',
           
            'password.required' => 'Le mot de passe est requis.',
            'profil.required' => 'Le profil est requis.',
            'adresse.required' => 'L\'adresse est requise.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            
        ];
    }
}
