<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Book);

        $books = Book::paginate(8);
        $genres = Genre::all();
        $authors = Author::all();
        $categories = Category::all();
        return view('backoffice.books.index', compact(
            'books', 'authors', 'genres', 'categories'
        ))
            /* ->with('books', $books)
            ->with('genres', $genres)
            ->with('authors', $authors)
            ->with('categories', $categories) */;
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
    public function store(StoreBookRequest $request, Book $book)
    {
        $this->authorize('create', $book);

        $book->saveBook($request);

        return redirect()->route('book.index')->with('success', '¡Libro guardado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $this->authorize('view', $book);

        $genres = Genre::all();
        $authors = Author::all();
        $categories = Category::all();
        return view('backoffice.books.show', compact('book', 'genres', 'authors', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $book->updateBook($book, $request);

        return redirect()->route('book.show', $book)->with('success', '¡Libro actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
