<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $user = $this->route()->parameter('user');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['same:password', 'string', 'min:8'],
            'roles' => ['required']
        ];

        if ($user) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user'))];
        }else{            
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')];
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nombre es requerido',
            'email.required' => 'Email es requerido',
            'email.email' => 'Email inválido',
            'password.required' => 'Nueva contraseña requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password_confirmation.same' => 'Las contraseñas no coinciden',
            'roles.required' => 'Rol es requerido',
        ];
    }
}
