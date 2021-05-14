@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('layouts.message', ['message' => session('success'), 'color' => 'orange'])
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('genre.index') }}">Género</a>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg>
        <a href="{{ route('genre.show', $genre) }}" class="font-semibold">Vista del género</a>
    @endsection

    <div class="my-6 px-2 md:px-8 py-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between">
            <h2 class="mb-5 font-titles font-semibold text-xl">{{ $books->count() }} libro(s) con el género <span class="text-red-900">{{ $genre->name }}</span></h2>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="flex py-3 px-4 font-bodies text-white bg-orange-500 hover:bg-orange-600 rounded-sm focus:outline-none">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('genre.update', $genre) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Edición de Géneros</h2>
                                        <small>Cambia los datos si deseas actualizar este género</small>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <div class="flex flex-wrap sm:px-10">
                                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                Nombre:
                                            </label>

                                            <input id="name" type="text"
                                                class="form-input w-full border border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                                value="{{ $genre->name ?? old('name') }}" autocomplete="name" autofocus>

                                            @error('name')
                                                <small class="text-red-500 text-xs italic mt-2">
                                                    {{ $message }}
                                                </small>
                                            @enderror
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
        @if ($books->count())
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold text-gray-700 bg-gray-200 text-left">
                            <th class="p-4 rounded-tl-sm">Título</th>
                            <th class="p-4">Autor</th>
                            <th class="p-4">Publicación</td>
                            <th class="p-4 rounded-tr-sm">Subgéneros</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr class="font-bodies border-b border-gray-200">
                                <td class="p-4">{{ $book->title }}</td>
                                <td class="p-4">{{ $book->author->name }}</td>
                                <td class="p-4">{{ $book->publication_year }}</td>
                                <td class="p-4">{{ ($book->categories->count() > 0) ? $book->categories->pluck('name')->implode(', ') : 'No tiene' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="font-bodies my-5">
                    {{ $books->links() }}
                </div>
            </div>
        @else
            <div class="p-2 px-4 leading-6 bg-red-200 border-red-600 text-red-600 border-l-4" role="alert">
                <p class="font-bold">
                    No hay libros
                </p>
                <p>
                    Al parecer no hay libros registrados con este género.
                </p>
            </div>
        @endif
    </div>
@endsection
