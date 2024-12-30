<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarCategoriasRequest extends FormRequest
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
            'nombreCategoria' => 'required|string|max:50|unique:categorias,categoria',
        ];
    }

    public function messages(): array
{
    return [


        'nombreCategoria.unique' => 'El "Nombre de la categoría" ya está registrado, elige uno diferente.',
        'nombreCategoria.required' => 'El campo "Nombre de la categoría" es obligatorio.',
        'nombreCategoria.string' => 'El campo "Nombre de la categoría" debe ser una cadena de texto.',
        'nombreCategoria.max' => 'El campo "Nombre de la categoría" no debe superar los 50 caracteres.',
    ];
}
}
