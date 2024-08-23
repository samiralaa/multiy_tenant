<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
 
        public function rules()
        {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ];
        }
    
        /**
         * Customize the error messages for validation rules.
         *
         * @return array
         */
        public function messages()
        {
            return [
                'email.unique' => 'The email address is already taken.',
                'password.confirmed' => 'Passwords do not match.',
            ];
        }
    
}
