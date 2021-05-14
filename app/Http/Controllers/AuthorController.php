<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use PragmaRX\Countries\Package\Countries;

class AuthorController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Author);

        return view('backoffice.author.index', [
            'authors' => Author::paginate(4),
            'countries' => Countries::all()->pluck('name.common')->toArray()
        ]);
    }

    public function store(StoreAuthorRequest $request, Author $author)
    {
        $this->authorize('create', $author);

        $author->saveAuthor($request);

        return redirect()->route('author.index')->with('success', '¡Autor guardado exitosamente!');
    }

    public function show(Author $author)
    {
        $this->authorize('view', $author);

        return view('backoffice.author.show', [
            'author' => $author,
            'books' => $author->books()->paginate(4),
            'countries' => Countries::all()->pluck('name.common')->toArray(),
            'flag' => Countries::where('name.common', $author->country)->first()->flag->flag_icon
        ]);
    }

    public function update(StoreAuthorRequest $request, Author $author)
    {
        $this->authorize('update', $author);

        $author->updateAuthor($author, $request);

        return redirect()->route('author.show', $author)->with('success', '¡Autor actualizado exitosamente!');
    }
}
