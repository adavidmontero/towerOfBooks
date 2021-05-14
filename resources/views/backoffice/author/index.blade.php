@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('layouts.message', ['message' => session('success'), 'color' => 'green'])
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('author.index') }}" class="font-semibold">Autores</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.473 7.196c-.425-.439-.401-1.127.035-1.552l4.461-4.326c.218-.211.498-.318.775-.318.282 0 .563.11.776.331l-6.047 5.865zm-7.334 11.021c-.092.089-.139.208-.139.327 0 .25.204.456.456.456.114 0 .229-.042.317-.128l.749-.729-.633-.654-.75.728zm6.33-8.425l-2.564 2.485c-1.378 1.336-2.081 2.63-2.73 4.437l1.132 1.169c1.825-.593 3.14-1.255 4.518-2.591l2.563-2.486-2.919-3.014zm7.477-7.659l-6.604 6.405 3.326 3.434 6.604-6.403c.485-.469.728-1.093.728-1.718 0-2.088-2.53-3.196-4.054-1.718zm-1.946 11.333v7.534h-16v-12h8.013l2.058-2h-12.071v16h20v-11.473l-2 1.939z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Listado de Autores</h2>
            </div>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="py-3 px-6 font-bodies text-white bg-red-800 hover:bg-red-700 rounded-sm focus:outline-none">
                    + Nuevo
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('author.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Registro de Autores</h2>
                                        <small>Ingrese los datos para la creación de un nuevo autor</small>
                                    </div>
                                    <div class="p-4 bg-white h-56 md:h-96 overflow-y-auto">
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

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="dob" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Fecha de Nacimiento:
                                                </label>

                                                <input id="dob" type="date"
                                                    class="form-input w-full border border-gray-400 @error('dob') border-red-500 @enderror" name="dob"
                                                    value="{{ old('dob') }}" {{-- required --}} autocomplete="dob" autofocus>

                                                @error('dob')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="country" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    País:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('genre') border-red-500 @enderror" 
                                                    name="country" id="country" autofocus>
                                                    <option value="" disabled selected>--Seleccione un país--</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country }}">{{ $country }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="dod" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Fecha de Defunción:
                                                </label>

                                                <input id="dod" type="date"
                                                    class="form-input w-full border border-gray-400 @error('dod') border-red-500 @enderror" name="dod"
                                                    value="{{ old('dod') }}" autocomplete="dod" autofocus>
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Imagen <span class="font-normal">(Las dimensiones de la imagen deben ser mayor a 500px)</span> :
                                                </label>

                                                <input id="image" type="file"
                                                    class="form-input w-full border border-gray-400 @error('image') border-red-500 @enderror" name="image"
                                                    value="{{ old('image') }}" {{-- required --}} autocomplete="image" autofocus>
                                                    
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
            Gestiona todos los autores registrados en el sistema. Como administrador y 
            secretario podrás visualizar los autores existentes. Además podrás agregar 
            nuevos autores según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($authors->count())
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold text-gray-700 bg-gray-200 text-left">
                            <th class="p-4 rounded-tl-sm">Imagen</th>
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Libros</th>
                            <th class="p-4">Edad</td>
                            <th class="p-4 text-center rounded-tr-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr class="font-bodies border-b border-gray-200">
                                <td class="p-4">
                                    <img class="w-10 h-10 md:w-16 md:h-16 rounded-full border border-gray-400" src="{{ $author->image_url }}" alt="profile">
                                </td>
                                <td class="p-4">{{ $author->name }}</td>
                                <td class="p-4">{{ $author->books()->count() }}</td>
                                <td class="p-4">{{ ($author->dod !== null) ? \Carbon\Carbon::parse($author->dod)->diff($author->dob, $author->dod)->format('%y años') : \Carbon\Carbon::parse($author->dob)->age . ' años' }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('author.show', $author) }}" class="">
                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="font-bodies my-5">
                    {{ $authors->links() }}
                </div>
            </div>
        @else
            <div class="p-2 px-4 leading-6 bg-red-200 border-red-600 text-red-600 border-l-4" role="alert">
                <p class="font-bold">
                    No hay autores
                </p>
                <p>
                    Al parecer no hay autores registrados aún.
                </p>
            </div>
        @endif
    </div>
@endsection
