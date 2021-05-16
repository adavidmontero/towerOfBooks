@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('backoffice.layouts.message', ['message' => session('success'), 'color' => 'orange'])
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('book.index') }}">Libros</a>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg>
        <a href="{{ route('book.show', $book) }}" class="font-semibold">Vista del libro</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center">
            <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2.033 16.01c.564-1.789 1.632-3.932 1.821-4.474.273-.787-.211-1.136-1.74.209l-.34-.64c1.744-1.897 5.335-2.326 4.113.613-.763 1.835-1.309 3.074-1.621 4.03-.455 1.393.694.828 1.819-.211.153.25.203.331.356.619-2.498 2.378-5.271 2.588-4.408-.146zm4.742-8.169c-.532.453-1.32.443-1.761-.022-.441-.465-.367-1.208.164-1.661.532-.453 1.32-.442 1.761.022.439.466.367 1.209-.164 1.661z"/></svg>
            <h2 class="font-titles font-semibold text-xl">Detalles del libro</h2>
        </div>
        <p class="font-bodies text-justify pt-4 leading-6">
            Vista detallada del libro donde el usuario podrá actualizar toda la información de este
            (título, año de publicación, autor, extracto, género y subgéneros).
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between mb-5 p-6 text-gray-700 bg-gray-200">
            <h2 class="self-center font-titles font-semibold text-xl">Datos de: {{ $book->title }}</h2>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="flex py-3 px-4 font-bodies text-white bg-orange-500 hover:bg-orange-600 rounded-sm focus:outline-none">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('book.update', $book) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Edición de Libros</h2>
                                        <small>Cambia los datos si deseas actualizar este libro</small>
                                    </div>
                                    <div class="p-4 bg-white h-56 md:h-96 overflow-y-auto">
                                        <div class="p-4">
                                            <div class="flex flex-wrap px-6 sm:px-10">
                                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Título:
                                                </label>

                                                <input id="title" type="text"
                                                    class="form-input w-full border border-gray-400 @error('title') border-red-500 @enderror" name="title"
                                                    value="{{ $book->title ?? old('title') }}" autocomplete="title" autofocus>

                                                @error('title')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="publication_year" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Año de Publicación:
                                                </label>

                                                <input id="publication_year" type="text"
                                                    class="form-input w-full border border-gray-400 @error('publication_year') border-red-500 @enderror" name="publication_year"
                                                    value="{{ $book->publication_year ?? old('publication_year') }}" autocomplete="publication_year" autofocus>
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="author" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Autor:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('author') border-red-500 @enderror" 
                                                    name="author" id="author" autofocus>
                                                    <option value="" disabled selected>--Seleccione un autor--</option>
                                                    @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}" {{ ($book->author->id === $author->id) ? 'selected' : '' }}>{{ $author->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('author')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="excerpt" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Extracto:
                                                </label>

                                                <textarea class="form-input w-full border border-gray-400 @error('excerpt') border-red-500 @enderror"
                                                    name="excerpt" id="excerpt" rows="4" autocomplete="excerpt" autofocus>{{ $book->excerpt ?? old('excerpt') }}</textarea>
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="genre" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Género:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('genre') border-red-500 @enderror" 
                                                    name="genre" id="genre" autofocus>
                                                    <option value="" disabled selected>--Seleccione un género--</option>
                                                    @foreach ($genres as $genre)
                                                        <option value="{{ $genre->id }}" {{ ($book->genre->id === $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('genre')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="categories" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Subgéneros:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('categories') border-red-500 @enderror" 
                                                    name="categories[]" id="categories" autofocus multiple>
                                                    <option value="" disabled>--Seleccione uno o más subgéneros--</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ ($book->categories->contains($category->id)) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('categories')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg bg-gray-200">
                                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                            Actualizar
                                        </button>
                                        <button @click="modalOpen = !modalOpen" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Modal -->
        </div>
        <div class="md:flex gap-4 mb-0 md:mb-2">
            <div class="w-full text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Título</h2>
                <p class="p-4">{{ $book->title }}</p>
            </div>
            <div class="w-full text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Año de Publicación</h2>
                <p class="p-4">{{ $book->publication_year }}</p>
            </div>
        </div>
        <div class="md:flex gap-4 mb-0 md:mb-2">
            <div class="w-full text-center">
                <h2 class="p-2 mb-4 font-titles font-semibold text-gray-700 bg-gray-200">Autor</h2>
                <div>
                    <img class="w-16 h-16 md:w-20 md:h-20 mx-auto rounded-full border border-gray-400" 
                        src="{{ asset($book->author->image_url) }}" alt="profile_photo">
                    <p class="p-4">{{ $book->author->name }}</p>
                </div>
            </div>
            <div class="w-full text-center">
                <h2 class="p-2 mb-4 font-titles font-semibold text-gray-700 bg-gray-200">Extracto</h2>
                <div>
                    <p class="px-2 text-justify leading-6">{{ $book->excerpt }}</p>
                </div>
            </div>
        </div>
        <div class="md:flex gap-4 mb-0 md:mb-2">
            <div class="w-full text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Género</h2>
                <p class="p-4">{{ $book->genre->name }}</p>
            </div>
            <div class="w-full text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Subgéneros</h2>
                <p class="p-4">{{ $book->categories->pluck('name')->implode(', ') }}</p>
            </div>
        </div>
    </div>
@endsection
