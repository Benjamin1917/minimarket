<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
            'rut' => 'required|string|unique:usuarios,rut|max:12|min:10',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'password' => 'required|string|min:8',
            'rol' => 'required|string|max:40|exists:roles,id_rol',
        ];
    }

    public function messages(): array
{
    return [
        'rut.required' => 'El campo rut es obligatorio.',
        'rut.string' => 'El campo rut debe ser una cadena de texto.',
        'rut.unique' => 'El rut ya está registrado, por favor ingresa uno diferente.',
        'rut.max' => 'El campo rut puede tener maximo 12 caracteres',
        
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
        'nombre.max' => 'El campo nombre no debe exceder los 30 caracteres.',
        
        'apellido.required' => 'El campo apellido es obligatorio.',
        'apellido.string' => 'El campo apellido debe ser una cadena de texto.',
        'apellido.max' => 'El campo apellido no debe exceder los 30 caracteres.',
        
        'password.required' => 'El campo contraseña es obligatorio.',
        'password.string' => 'El campo contraseña debe ser una cadena de texto.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        
        'rol.required' => 'El campo rol es obligatorio.',
        'rol.exists' => 'El rol seleccionado no es válido.',
    ];
}
}
