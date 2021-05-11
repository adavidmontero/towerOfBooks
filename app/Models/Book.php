<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'excerpt', 'publication_year', 'genre_id', 'author_id', 'categories_id'
    ];

    /* RELACIONES */

    // Un libro pertenece a un autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Un libro tiene muchas categorías o subgéneros
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Un libro tiene muchas copias
    public function copies()
    {
        return $this->hasMany(Copy::class);
    }

    // Un libro pertenece a un género
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /* ALMACENAMIENTO */

    public function saveBook($request) 
    {
        //Asignamos a cada atributo los valores validados
        $book = new Book([
            'title' => $request['title'],
            'excerpt' => $request['excerpt'],
            'publication_year' => $request['publication_year'],
            'genre_id' => $request['genre'],
            'author_id' => $request['author']
        ]);

        //Guardamos el libro
        $book->save();

        //Asignamos todos los subgéneros al libro
        $book->categories()->sync($request['categories']);
    }

    public function updateBook($book, $request)
    {
        //Actualizamos la información con los valores validados desde el request
        $book->update([
            'title' => $request['title'],
            'excerpt' => $request['excerpt'],
            'publication_year' => $request['publication_year'],
            'genre_id' => $request['genre'],
            'author_id' => $request['author'],
        ]);
        
        //Asignamos todos los subgéneros al libro
        $book->categories()->sync($request['categories']);
    }
}
