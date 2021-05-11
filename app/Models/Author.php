<?php

namespace App\Models;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'dob', 'country', 'dod', 'image_url'
    ];

    /* RELACIONES */

    //Un autor tiene muchos libros
    public function books() 
    {
        return $this->hasMany(Book::class);
    }

    /* ALMACENAMIENTO */
    public function saveAuthor($request)
    {
        if ($request->file('image')) {
            //Obtenemos la ruta de la imagen
            $ruta_imagen = $request->file('image')->store('upload-autores', 'public');
            //Recortamos la imagen para que sea cuadrada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300, 300);
            //Guardamos la imagen en el directorio
            $img->save();
        }

        //Asignamos los valores previamente validados
        $author = new Author([
            'name' => $request['name'],
            'dob' => $request['dob'],
            'country' => $request['country'],
            'dod' => $request['dod'],
            //Si el usuario no sube una imagen se guarda la url de una por defecto
            'image_url' => (isset($ruta_imagen))
                ? 'storage/' . $ruta_imagen 
                : './images/placeholder-profile-male-500x500.png',
        ]);

        //Guardamos el autor
        $author->save();
    }

    public function updateAuthor($author, $request)
    {
        //Borramos la imagen si el usuario mandó una nueva
        if ($request->hasFile('image')) {
            //Verificamos que el archivo exista
            if (Storage::exists(Str::of($author['image_url'])->replace('storage', 'public'))) {
                //Si existe eliminamos la imagen
                Storage::delete(Str::of($author['image_url'])->replace('storage', 'public'));
            }

            //Guardamos la nueva imagen
            $ruta_imagen = $request->file('image')->store('upload-autores', 'public');

            //Recortamos la imagen para que sea cuadrada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300, 300);
            //Guardamos ese cambio
            $img->save();
        }

        //Guardamos los cambios
        $author->update([
            'name' => $request['name'],
            'dob' => $request['dob'],
            'country' => $request['country'],
            'dod' => $request['dod'],
            'image_url' => (isset($ruta_imagen)) ? 'storage/' . $ruta_imagen : $author['image_url'],
        ]);
    }
}
