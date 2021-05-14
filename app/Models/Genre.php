<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
    /** RELACIONES */

    // Un género tiene muchos libros
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /** ALMACENAMIENTO */

    public function saveGenre($request)
    {
        $request->validate([
            'name' => 'required|unique:genres,name|min:4|max:20'
        ]);

        $genre = new Genre($request->all());
        $genre->save();
    }

    public function updateGenre($request, $genre)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('genres', 'name')->ignore($genre->id),
                'min:4',
                'max:20'
            ]
        ]);

        $genre->update($request->all());
    }
}
