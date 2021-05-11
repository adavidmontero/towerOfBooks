<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|min:5',
            'dob' => 'required',
            'country' => 'required',
            'image' => 'dimensions:min_width=500,min_height=500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe ser mayor a 5 caracteres',
            'name.max' => 'El campo nombre debe ser menor a 50 caracteres',
            'dob.required' => 'El campo fecha de nacimiento es obligatorio',
            'country.required' => 'El campo país es obligatorio',
            'image.dimensions' => 'Las dimensiones de la imagen deben ser mayor a 500px'
        ];
    }
}
