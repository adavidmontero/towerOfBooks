<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Copy extends Model
{
    use HasFactory;

    protected $fillable = [
        'copy_id', 'editorial', 'pages', 'image_url', 'book_id'
    ];

    /** RELACIONES */

    // Una copia pertenece a un libro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // 1 copia tiene muchos prestamos
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /** ALMACENAMIENTO */

    public function saveCopy($request)
    {
        $request->validate([
            'copy_id' => 'required|unique:copies,copy_id|max:30',
            'editorial' => 'required|min:2|max:30',
            'pages' => 'required|numeric',
            'image' => 'dimensions:min_width=300,min_height=450',
            'book' => 'required|numeric'
        ]);

        if ($request->file('image')) {
            //Obtenemos la ruta de la imagen
            $ruta_imagen = $request->file('image')->store('upload-copies', 'public');
            //Recortamos la imagen para que se ajuste a lo requerido
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300, 450);
            //Guardamos la imagen en el directorio
            $img->save();
        }

        //Asignamos los valores previamente validados
        $copy = new Copy([
            'copy_id' => $request['copy_id'],
            'editorial' => $request['editorial'],
            'pages' => $request['pages'],
            //Si el usuario no sube una imagen se guarda la url de una por defecto
            'image_url' => (isset($ruta_imagen))
                ? 'storage/' . $ruta_imagen
                : 'https://via.placeholder.com/300x450',
            'book_id' => $request['book']
        ]);

        //Guardamos la copia
        $copy->save();
    }

    public function updateCopy($request, $copy)
    {
        $request->validate([
            'copy_id' => ['required', 'max:30', 'unique:copies,copy_id,' . $copy->id],
            'editorial' => 'required|min:2|max:30',
            'pages' => 'required|numeric',
            'image' => 'dimensions:min_width=300,min_height=450',
            'book' => 'required|numeric'
        ]);

        //Borramos la imagen si el usuario mandó una nueva
        if ($request->hasFile('image')) {
            //Verificamos que el archivo exista
            if (Storage::exists(Str::of($copy['image_url'])->replace('storage', 'public'))) {
                //Si existe eliminamos la imagen
                Storage::delete(Str::of($copy['image_url'])->replace('storage', 'public'));
            }

            //Guardamos la nueva imagen
            $ruta_imagen = $request->file('image')->store('upload-copies', 'public');

            //Recortamos la imagen para que sea cuadrada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300, 450);
            //Guardamos ese cambio
            $img->save();
        }

        //Guardamos los cambios
        $copy->update([
            'copy_id' => $request['copy_id'],
            'editorial' => $request['editorial'],
            'pages' => $request['pages'],
            'image_url' => (isset($ruta_imagen)) ? 'storage/' . $ruta_imagen : $copy['image_url'],
            'book_id' => $request['book']
        ]); 
    }
}
