<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedoresRequest extends FormRequest
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

            'nombreProveedor' => 'required|string|max:100',
            'contactoProveedor' => 'required|string|max:12|unique:proveedores,contacto',
        ];
    }

    public function messages(): array
{
    return [
        


       
        'nombreProveedor.required' => 'El campo "Nombre del proveedor" es obligatorio.',
        'nombreProveedor.string' => 'El campo "Nombre del proveedor" debe ser una cadena de texto.',
        'nombreProveedor.max' => 'El campo "Nombre del proveedor" no debe superar los 100 caracteres.',

       
        'contactoProveedor.required' => 'El campo "Contacto del proveedor" es obligatorio.',
        'contactoProveedor.string' => 'El campo "Contacto del proveedor" debe ser una cadena de texto.',
        'contactoProveedor.max' => 'El campo "Contacto del proveedor" no debe superar los 12 caracteres.',
        'contactoProveedor.unique' => 'El contacto ingresado ya está registrado. Por favor, elige otro.',
    ];
}

}
