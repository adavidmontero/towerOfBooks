@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('backoffice.layouts.message', ['message' => session('success'), 'color' => 'green'])
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('copy.index') }}" class="font-semibold">Ejemplares</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23 5v13.883l-1 .117v-16c-3.895.119-7.505.762-10.002 2.316-2.496-1.554-6.102-2.197-9.998-2.316v16l-1-.117v-13.883h-1v15h9.057c1.479 0 1.641 1 2.941 1 1.304 0 1.461-1 2.942-1h9.06v-15h-1zm-12 13.645c-1.946-.772-4.137-1.269-7-1.484v-12.051c2.352.197 4.996.675 7 1.922v11.613zm9-1.484c-2.863.215-5.054.712-7 1.484v-11.613c2.004-1.247 4.648-1.725 7-1.922v12.051z"/></svg>
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
                                        <small>Ingrese los datos para la creaci??n de un nuevo ejemplar</small>
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
                                                    P??ginas:
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
            secretario podr??s visualizar los libros existentes. Adem??s podr??s agregar 
            nuevos libros seg??n lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($copies->count())
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold text-gray-700 bg-gray-200 text-left">
                            <th class="p-4 rounded-tl-sm">T??tulo</th>
                            <th class="p-4">Editorial</th>
                            <th class="p-4 truncate">P??ginas</th>
                            <th class="p-4">Estado</td>
                            <th class="p-4 rounded-tr-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($copies as $copy)
                            <tr class="font-bodies border-b border-gray-200">
                                <td class="p-4">{{ $copy->book->title }}</td>
                                <td class="p-4">{{ $copy->editorial }}</td>
                                <td class="p-4">{{ $copy->pages }}</td>
                                <td class="p-4">
                                    @if($copy->state === 'Disponible') 
                                        <span class="px-2 py-1 text-xs bg-green-200 text-green-800 font-semibold rounded-lg">
                                            {{ $copy->state }}
                                        </span>
                                    @elseif($copy->state === 'Prestado')
                                        <span class="px-2 py-1 text-xs bg-orange-200 text-orange-800 font-semibold rounded-lg">
                                            {{ $copy->state }}
                                        </span>
                                    @elseif($copy->state === 'Retrasado')
                                        <span class="px-2 py-1 text-xs bg-red-200 text-red-800 font-semibold rounded-lg">
                                            {{ $copy->state }}
                                        </span>
                                    @elseif($copy->state === 'Inactivo')
                                        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-800 font-semibold rounded-lg">
                                            {{ $copy->state }}
                                        </span>
                                    @endif
                                </td>
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
            <div class="p-2 px-4 leading-6 bg-red-200 border-red-600 text-red-600 border-l-4" role="alert">
                <p class="font-bold">
                    No hay ejemplares
                </p>
                <p>
                    Al parecer no hay ejemplares registrados a??n.
                </p>
            </div>
        @endif
    </div>
@endsection
