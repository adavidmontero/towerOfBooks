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
        <a href="{{ route('copy.index') }}" class="font-semibold">Ejemplares</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.495 2h16.505v-2h-17c-1.656 0-3 1.343-3 3v18c0 1.657 1.344 3 3 3h17v-20h-16.505c-1.376 0-1.376-2 0-2zm7.561 7.273c.438-.372 1.084-.363 1.446.018.361.382.302.992-.135 1.364-.437.372-1.084.364-1.446-.018-.361-.382-.302-.992.135-1.364zm.583 4.567c-.627 1.508-1.075 2.525-1.331 3.31-.374 1.144.569.68 1.493-.173.127.206.167.271.294.508-2.054 1.953-4.331 2.125-3.623-.12.464-1.469 1.342-3.229 1.496-3.675.225-.646-.174-.934-1.429.171l-.278-.525c1.431-1.558 4.381-1.91 3.378.504z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Listado de Ejemplares</h2>
            </div>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="py-3 px-6 font-bodies text-white bg-red-800 hover:bg-red-700 rounded-sm focus:outline-none">
                    + Nuevo
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('copy.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Registro de Ejemplares</h2>
                                        <small>Ingrese los datos para la creación de un nuevo ejemplar</small>
                                    </div>
                                    <div class="p-4 bg-white h-56 md:h-96 overflow-y-auto">
                                        <div class="p-4">
                                            <div class="flex flex-wrap px-6 sm:px-10">
                                                <label for="book" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Libro:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('book') border-red-500 @enderror" 
                                                    name="book" id="book" autofocus>
                                                    <option value="" disabled selected>--Seleccione el libro--</option>
                                                    @foreach ($books as $id => $title)
                                                        <option value="{{ $id }}">{{ $title }}</option>
                                                    @endforeach
                                                </select>

                                                @error('book')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="copy_id" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    ID del Ejemplar:
                                                </label>

                                                <input id="copy_id" type="text" value="{{ old('copy_id') }}" name="copy_id" autofocus
                                                    class="form-input w-full border border-gray-400 @error('copy_id') border-red-500 @enderror">

                                                @error('copy_id')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="editorial" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Editorial:
                                                </label>

                                                <input id="editorial" type="text" value="{{ old('editorial') }}" name="editorial" autofocus
                                                    class="form-input w-full border border-gray-400 @error('editorial') border-red-500 @enderror">

                                                @error('editorial')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="pages" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Páginas:
                                                </label>

                                                <input id="pages" type="number"
                                                    class="form-input w-full border border-gray-400 @error('pages') border-red-500 @enderror" name="pages"
                                                    value="{{ old('pages') }}" autocomplete="pages" autofocus>
                                            
                                                @error('pages')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Imagen <span class="font-normal">(La altura debe ser mayor a 450px y el ancho mayor a 300px)</span> :
                                                </label>

                                                <input id="image" type="file"
                                                    class="form-input w-full border border-gray-400 @error('image') border-red-500 @enderror" name="image"
                                                    value="{{ old('image') }}" autocomplete="image" autofocus>
                                                    
                                                @error('image')
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
            Gestiona todos los libros registrados en el sistema. Como administrador y 
            secretario podrás visualizar los libros existentes. Además podrás agregar 
            nuevos libros según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($copies->count())
            <div class="rounded-md overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold bg-black text-white text-left">
                            <th class="p-4 rounded-tl-sm">Título</th>
                            <th class="p-4">Editorial</th>
                            <th class="p-4 truncate">Páginas</th>
                            <th class="p-4">Estado</td>
                            <th class="p-4 rounded-tr-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($copies as $copy)
                            <tr class="font-bodies @if($loop->index % 2 === 0) bg-gray-200 @endif">
                                <td class="p-4">{{ $copy->book->title }}</td>
                                <td class="p-4">{{ $copy->editorial }}</td>
                                <td class="p-4">{{ $copy->pages }}</td>
                                <td class="p-4">state</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('copy.show', $copy) }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="font-bodies mt-5">
                    {{ $copies->links() }}
                </div>
            </div>
        @else
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4" role="alert">
                <p class="font-bold">
                    No hay ejemplares
                </p>
                <p>
                    Al parecer no hay ejemplares registrados aún.
                </p>
            </div>
        @endif
    </div>
@endsection
