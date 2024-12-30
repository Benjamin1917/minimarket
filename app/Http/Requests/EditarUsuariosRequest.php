<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarUsuariosRequest extends FormRequest
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
            'rut' => 'required|string|max:12|min:10|unique:usuarios,rut,' . $this->route('rut') . ',rut',
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:30',
            'password' => 'sometimes|nullable|string|min:8',
            'rol' => 'required|string|max:40|exists:roles,id_rol',
        ];
    }

    public function messages(): array
{
    return [
        'rut.required' => 'El campo rut es obligatorio.',
        'rut.string' => 'El rut debe ser una cadena de texto.',
        'rut.max' => 'El rut no debe exceder los 12 caracteres.',
        'rut.min' => 'El rut debe tener al menos 10 caracteres.',
        'rut.unique' => 'El rut :input ya está registrado en el sistema. Si desea editar este usuario, por favor, asegúrese de que el rut no haya cambiado.',
        
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
