<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.copy.index', [
            'copies' => Copy::paginate(10),
            'books' => Book::all()->pluck('title', 'id')
        ]);
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
        $request->validate([
            'copy_id' => 'required|max:30',
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

        //Guardamos el autor
        $copy->save();

        return redirect()->route('copy.index')->with('status', 'Ejemplar guardado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function show(Copy $copy)
    {
        return view('backoffice.copy.show', compact('copy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function edit(Copy $copy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Copy $copy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Copy $copy)
    {
        //
    }
}
