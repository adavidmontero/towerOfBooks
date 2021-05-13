<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('frontoffice.profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
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

        return redirect()->route('profile.show', $profile)->with('status', 'Perfil actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
