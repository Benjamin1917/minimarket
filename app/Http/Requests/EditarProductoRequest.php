<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarProductoRequest extends FormRequest
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
            'editCategoria' => 'required|exists:categorias,id_categoria', // Asegúrate de que la categoría existe
            'editProductName' => 'required|string|max:30',
            'editMarca' => 'nullable|string|max:30',
            'editPrice' => 'required|numeric|min:0',
            'editStock' => 'required|integer|min:0',
        ];


    }
    
    public function messages()
    {
        return [
            'editCategoria.required' => 'La categoría es obligatoria.',
            'editCategoria.exists' => 'La categoría seleccionada no es válida.',
            'editProductName.required' => 'El nombre del producto es obligatorio.',
            'editProductName.string' => 'El nombre del producto debe ser una cadena de texto.',
            'editProductName.max' => 'El nombre del producto no debe exceder los 30 caracteres.',
            'editMarca.string' => 'La marca debe ser una cadena de texto.',
            'editMarca.max' => 'La marca no debe exceder los 30 caracteres.',
            'editPrice.required' => 'El precio es obligatorio.',
            'editPrice.numeric' => 'El precio debe ser un número.',
            'editPrice.min' => 'El precio no puede ser negativo.',
            'editStock.required' => 'La cantidad de stock es obligatoria.',
            'editStock.integer' => 'La cantidad de stock debe ser un número entero.',
            'editStock.min' => 'La cantidad en stock no puede ser negativa.',
        ];
    }
}
