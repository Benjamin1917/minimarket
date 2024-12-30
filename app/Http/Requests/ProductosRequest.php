<?php

namespace App\Http\Requests;
use App\Models\Producto;

use Illuminate\Foundation\Http\FormRequest;

class ProductosRequest extends FormRequest
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
            'idProducto' => [
                'required',
                'integer',
                'max:255',
                function ($attribute, $value, $fail) {
                    $producto = Producto::where('id_producto', $value)->first();
                    if ($producto) {
                        $fail('El ID del producto ya está asignado al producto "' . $producto->nombre_producto . '".');
                    }
                },
            ],
            'nombreProducto' => [
                'required',
                'string',
                'max:30',
                'unique:productos,nombre_producto,NULL,id_producto,id_marca,' . $this->input('marca'),
            ],
            'marca' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0|max:0',
            'categoria' => 'required|string|max:40|exists:categorias,id_categoria',
        ];
    }

    public function messages(): array
{
    return [
        'idProducto.required' => 'Indique el ID del producto.',
        'idProducto.unique' => 'El ID :input ya está asignado a otro producto.',
        'idProducto.max' => 'El ID del producto no debe exceder los 255 caracteres.',
        'idProducto.integer' => 'El ID debe ser un número entero.',
        'nombreProducto.required' => 'Indique el nombre del producto.',
        'nombreProducto.unique' => 'El nombre del producto ya está registrado para esta marca.',
        'nombreProducto.string' => 'El nombre del producto debe ser una cadena de texto.',
        'nombreProducto.max' => 'El nombre del producto no debe exceder los 30 caracteres.',
        'marca.required' => 'Indique la marca del producto.',
        'marca.string' => 'La marca debe ser una cadena de texto.',
        'marca.max' => 'La marca no debe exceder los 30 caracteres.',
        'precio.required' => 'Indique el precio del producto.',
        'precio.numeric' => 'El precio debe ser un número.',
        'precio.min' => 'El precio no puede ser negativo.',
        'stock.required' => 'Indique la cantidad en stock del producto.',
        'stock.integer' => 'La cantidad en stock debe ser un número entero.',
        'stock.min' => 'La cantidad en stock no puede ser negativa.',
        'stock.max' => 'La cantidad en stock debe ser 0.',
        'categoria.required' => 'Indique la categoría del producto.',
        'categoria.string' => 'La categoría debe ser una cadena de texto.',
        'categoria.max' => 'La categoría no debe exceder los 40 caracteres.',
        'categoria.exists' => 'La categoría indicada no existe en el sistema.',
    ];
}

}
