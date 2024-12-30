<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroProductoRequest extends FormRequest
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
            'id_proveedor' => 'required|exists:proveedores,id_proveedor|integer',
            'id_producto' => 'required|exists:productos,id_producto|integer',
            'rut_usuario' => 'required|exists:usuarios,rut|string',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
            'cantidad_ingresada' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
{
    return [
        
        'id_proveedor.required' => 'El campo "ID del proveedor" es obligatorio.',
        'id_proveedor.exists' => 'El "ID del proveedor" no existe en el sistema.',
        'id_proveedor.integer' => 'El campo "ID del proveedor" debe ser un número entero.',

        
        'id_producto.required' => 'El campo "ID del producto" es obligatorio.',
        'id_producto.exists' => 'El "ID del producto" no existe en el sistema.',
        'id_producto.integer' => 'El campo "ID del producto" debe ser un número entero.',

        
        'rut_usuario.required' => 'El campo "RUT del usuario" es obligatorio.',
        'rut_usuario.exists' => 'El "RUT del usuario" no existe en el sistema.',
        'rut_usuario.string' => 'El campo "RUT del usuario" debe ser una cadena de texto.',

        
        'fecha_ingreso.required' => 'El campo "Fecha de ingreso" es obligatorio.',
        'fecha_ingreso.date' => 'El campo "Fecha de ingreso" debe ser una fecha válida.',
        'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser posterior al día de hoy.',

        
        'cantidad_ingresada.required' => 'El campo "Cantidad ingresada" es obligatorio.',
        'cantidad_ingresada.integer' => 'El campo "Cantidad ingresada" debe ser un número entero.',
        'cantidad_ingresada.min' => 'El campo "Cantidad ingresada" debe ser al menos 1.',
    ];
}
}
