<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcasRequest extends FormRequest
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
            'nombreMarca' => 'required|string|max:30|unique:marcas,nombre_marca', 
        ];
    }

    public function messages(): array
    {
        return [
            'nombreMarca.required' => 'El nombre de la marca es obligatorio.',
            'nombreMarca.string' => 'El nombre de la marca debe ser un texto válido.',
            'nombreMarca.max' => 'El nombre de la marca no debe exceder los 30 caracteres.',
            'nombreMarca.unique' => 'Ya existe una marca con ese nombre.',
        ];
    }
}
