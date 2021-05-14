<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|max:50',
            'excerpt' => 'max:350',
            'publication_year' => ['numeric', 'gte:0', 'lte:' . Carbon::now()->format('Y')],
            'genre' => 'required|numeric',
            'author' => 'required|numeric',
            'categories' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El campo título es obligatorio',
            'title.max' => 'El campo título no debe ser mayor a 50 caracteres',
            'excerpt.max' => 'El campo extracto no debe ser mayor a 300 caracteres',
            'publication_year.numeric' => 'El campo año de publicación debe ser un número',
            'publication_year.gte' => 'El campo año de publicación debe ser mayor a 0',
            'publication_year.lte' => 'El campo año de publicación debe ser menor al año actual',
            'genre.required' => 'El campo género es obligatorio',
            'genre.numeric' => 'El campo género debe ser un número',
            'author.required' => 'El campo autor es obligatorio',
            'author.numeric' => 'El campo autor debe ser un número',
            'categories.required' => 'El campo subgénero es obligatorio',
        ];
    }
}
