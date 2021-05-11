@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="flex justify-between p-4 bg-green-500 text-white font-bodies" x-data="{showAlert: true}" x-show="showAlert">
            <span class="mx-auto">{{ session('status') }}</span>
            <button @click="showAlert = !showAlert" class="text-center focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    @section('breadcrumb-items')
        <a href="{{ route('genre.index') }}" class="font-semibold">Géneros</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 13h-2v-4h2v4zm0-5h-2v-4h2v4zm0 6h-2v4h2v-4zm0 5h-2v4h2v-4zm-10.768-5.886c-.238.447-.392 1.025-.392 1.475 0 1.203 1.173 1.211 1.751.08.237-.465.391-1.058.391-1.51 0-.972-1.166-1.144-1.75-.045zm-5.737-9.114h13.505v20h-14c-1.656 0-3-1.343-3-3v-18c0-1.657 1.344-3 3-3h17v2h-16.505c-1.376 0-1.376 2 0 2zm2.505 10.159c0 2.098 1.409 3.724 4.014 3.724 1.44 0 2.356-.415 2.927-.736l-.392-.566c-.585.338-1.286.648-2.433.648-1.958 0-3.275-1.256-3.275-3.127 0-3.265 3.657-3.861 5.265-2.898 1.499.938 1.443 3.187.333 4.047-.592.472-1.257.456-1.042-.433 0 0 .693-2.564.774-2.842h-.778l-.156.543c-.158-.448-.539-.74-1.091-.74-1.153 0-2.128 1.251-2.128 2.733 0 .989.523 1.602 1.36 1.602.733 0 1.115-.415 1.351-.785-.172 1.659 3.271.893 3.271-2.012 0-1.854-1.503-3.2-3.575-3.2-2.837 0-4.425 1.8-4.425 4.042z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Listado de Géneros</h2>
            </div>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="py-3 px-6 font-bodies text-white bg-red-800 hover:bg-red-700 rounded-sm focus:outline-none">
                    + Nuevo
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('genre.store') }}">
                        @csrf

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Registro de Géneros</h2>
                                        <small>Ingrese los datos para la creación de un nuevo género</small>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <div class="p-4">
                                            <div class="flex flex-wrap px-6 sm:px-10">
                                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Nombre:
                                                </label>

                                                <input id="name" type="text"
                                                    class="form-input w-full border border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                                    value="{{ old('name') }}" {{-- required --}} autocomplete="name" autofocus>

                                                @error('name')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg bg-gray-200">
                                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                            Guardar
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
        <p class="font-bodies text-justify pt-4 leading-6">
            Gestiona todos los géneros registrados en el sistema. Como administrador y 
            secretario podrás visualizar los géneros existentes. Además podrás agregar 
            nuevos géneros según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($genres->count())
            <div class="rounded-md overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold bg-black text-white text-left">
                            <th class="p-4">Nombre</th>
                            <th class="p-4"># Libros</th>
                            <th class="p-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $genre)
                            <tr class="font-bodies @if($loop->index % 2 === 0) bg-gray-200 @endif">
                                <td class="p-4">{{ $genre->name }}</td>
                                <td class="p-4">{{ $genre->books()->count() }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('genre.show', $genre) }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="font-bodies my-5">
                    {{ $genres->links() }}
                </div>
            </div>
        @else
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4" role="alert">
                <p class="font-bold">
                    No hay géneros
                </p>
                <p>
                    Al parecer no hay géneros registrados aún.
                </p>
            </div>
        @endif
    </div>
@endsection
