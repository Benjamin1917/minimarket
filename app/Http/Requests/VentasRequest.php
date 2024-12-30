<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentasRequest extends FormRequest
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
            'productos.*.id_producto' => 'required|exists:productos,id_producto', // Validar que el producto exista
            'productos.*.cantidad' => 'required|integer|min:1', // Validar que la cantidad sea un número entero y mayor a 0
            'medio_pago' => 'required|string', // Validar que el medio de pago esté seleccionado
            'rut_usuario' => 'required|string', // Validar que el RUT esté presente
        ];
    }

    public function messages()
    {
        return [
            'productos.*.id_producto.required' => 'El producto es obligatorio.',
            'productos.*.id_producto.exists' => 'El producto seleccionado no existe.',
            'productos.*.cantidad.required' => 'La cantidad es obligatoria.',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'productos.*.cantidad.min' => 'La cantidad mínima es 1.',
            'medio_pago.required' => 'Debes seleccionar un medio de pago.',
            'rut_usuario.required' => 'El RUT del usuario es obligatorio.',
        ];
    }
}
