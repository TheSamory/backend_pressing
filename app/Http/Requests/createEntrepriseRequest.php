<?php

namespace App\Http\Requests;

use App\Models\entreprise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class createEntrepriseRequest extends FormRequest
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
            'email'=> 'required|unique:users,email',
            'ville' => 'required',
            'adresse' => 'required',
            'phone'=> 'required',
            'pays'=> 'required'
            
        ];
    }

         public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'status_code' => 422,
            'message' => 'Creation de l\'entreprise echoué',
            'errorsList' => $validator->errors(),
        ], 422));
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Un nom de l\'entreprise est requis.',
            'email.required' => 'Une adresse mail de l\'entreprise est requise.',
            'email.unique' => 'Cette adresse mail existe deja .',
            'ville.required' => 'La ville ou se situe l\'entreprise est requise.',
            'adresse.required' => 'L\'adresse est requise.',
             'pays.required' => 'Le pays ou se situe l\'entreprise est requis.',
            'phone.required' => 'Le numéro de téléphone de l\'entreprise est requis.',
            
        ];
    }
}
