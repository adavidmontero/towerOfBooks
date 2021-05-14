<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /** RELACIONES */

    // Una categoría tiene muchos libros
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /** ALMACENAMIENTO */

    public function saveCategory($request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|min:4|max:20'
        ]);

        $category = new Category($request->all());

        $category->save();
    }

    public function updateCategory($request, $category)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($category->id),
                'min:4',
                'max:20'
            ]
        ]);

        $category->update($request->all());
    }
}
