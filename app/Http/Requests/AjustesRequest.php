<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjustesRequest extends FormRequest
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
            'id_producto' => 'required|exists:productos,id_producto', // El producto debe existir
            'rut_usuario' => 'required|string|max:12|exists:usuarios,rut', // El RUT debe existir en la tabla de usuarios
            'cantidad' => 'required|integer|min:1', // La cantidad debe ser un número entero mayor a 0
            'tipo_ajuste' => 'required|string|in:merma,vencimiento,robo,otro', // Validar que el tipo de ajuste sea uno de los valores definidos
            'motivo' => 'required|string|max:255', // El motivo debe ser un texto
            'fecha' => 'required|date|date_format:Y-m-d|before_or_equal:today', // Validar que la fecha esté en el formato correcto
        ];
    }

    public function messages(): array
    {
        return [
            'id_producto.required' => 'El campo "Producto" es obligatorio.',
            'id_producto.exists' => 'El producto seleccionado no existe.',
            'rut_usuario.required' => 'El campo "RUT del Usuario" es obligatorio.',
            'rut_usuario.exists' => 'El RUT ingresado no pertenece a ningún usuario.',
            'cantidad.required' => 'El campo "Cantidad" es obligatorio.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser mayor que 0.',
            'tipo_ajuste.required' => 'El campo "Tipo de ajuste" es obligatorio.',
            'tipo_ajuste.in' => 'El tipo de ajuste debe ser "merma", "vencimiento", "robo" o "otro".',
            'motivo.required' => 'El campo "Motivo" es obligatorio.',
            'motivo.string' => 'El campo "Motivo" debe ser un texto.',
            'motivo.max' => 'El campo "Motivo" no debe superar los 255 caracteres.',
            'fecha.required' => 'El campo "Fecha" es obligatorio.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'fecha.before_or_equal' => 'La fecha de ingreso no puede ser posterior al día de hoy.',

            'fecha.date_format' => 'El formato de la fecha no es válido. Use "Y-m-d".',
        ];
    }
}
