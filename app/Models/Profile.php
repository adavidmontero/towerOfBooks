<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'number_id', 'telephone', 'address', 'description', 'image_url', 'user_id'
    ];

    /** RELACIONES */

    //1 perfil pertenece a 1 usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** ALMACENAMIENTO */

    public function updateProfile($request, $profile)
    {
        $request->validate([
            'type_id' => 'required',
            'number_id' => [
                'required',
                Rule::unique('profiles', 'number_id')->ignore($profile->id),
                'min:6',
                'max:12'
            ],
            'address' => 'min:5|max:50',
            'telephone' => 'min:7|max:10',
            'description' => 'max:300',
            'image' => 'dimensions:min_width=500,min_height=500'
        ]);

        //Borramos la imagen si el usuario mandó una nueva
        if ($request->hasFile('image')) {
            //Verificamos que el archivo exista
            if (Storage::exists(Str::of($profile['image_url'])->replace('storage', 'public'))) {
                //Si existe eliminamos la imagen
                Storage::delete(Str::of($profile['image_url'])->replace('storage', 'public'));
            }

            //Guardamos la nueva imagen
            $ruta_imagen = $request->file('image')->store('upload-profile', 'public');

            //Recortamos la imagen para que sea cuadrada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300, 300);
            //Guardamos ese cambio
            $img->save();
        }

        //Guardamos los cambios
        $profile->update([
            'type_id' => $request['type_id'],
            'number_id' => $request['number_id'],
            'telephone' => $request['telephone'],
            'address' => $request['address'],
            'description' => $request['description'],
            'image_url' => (isset($ruta_imagen)) ? 'storage/' . $ruta_imagen : $profile['image_url'],
        ]);
    }
}
