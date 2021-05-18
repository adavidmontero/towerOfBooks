@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('backoffice.layouts.message', ['message' => session('success'), 'color' => 'green'])
    @elseif(session('error'))
        @include('backoffice.layouts.message', ['message' => session('error'), 'color' => 'red'])
    @endif
@endsection

@section('breadcrumb-items')
    <a href="{{ route('loan.index') }}">Préstamos</a>
    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg>
    <a href="{{ route('loan.create') }}" class="font-semibold">Creación de préstamos</a>
@endsection

@section('content')
    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center">
            <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 12h-10v1h10v-1zm-4 2h-6v1h6v-1zm4-6h-10v1h10v-1zm0 2h-10v1h10v-1zm0-6h-10v1h10v-1zm0 2h-10v1h10v-1zm7.44 10.277c.183-2.314-.433-2.54-3.288-5.322.171 1.223.528 3.397.911 5.001.089.382-.416.621-.586.215-.204-.495-.535-2.602-.82-4.72-.154-1.134-1.661-.995-1.657.177.005 1.822.003 3.341 0 6.041-.003 2.303 1.046 2.348 1.819 4.931.132.444.246.927.339 1.399l3.842-1.339c-1.339-2.621-.693-4.689-.56-6.383zm-6.428 1.723h-13.012v-16h14v7.894c.646-.342 1.348-.274 1.877.101l.123-.018v-8.477c0-.828-.672-1.5-1.5-1.5h-15c-.828 0-1.5.671-1.5 1.5v17c0 .829.672 1.5 1.5 1.5h13.974c-.245-.515-.425-1.124-.462-2z"/></svg>
            <h2 class="font-titles font-semibold text-xl">Creación de préstamos</h2>
        </div>
        <p class="font-bodies text-justify pt-2 leading-6">
            En esta sección podrás asignar un préstamo de una copia a un lector, teniendo en cuenta una fecha
            inicial y una fecha límite en la que se espera que hagan la devolución. Si no es entregado antes 
            de tal fecha el lector será sancionado.
        </p>
    </div>

    <form method="POST" action="{{ route('loan.store') }}">
        @csrf
            
        <div class="md:w-1/2 md:min-w-max-content p-6 my-6 bg-white rounded-md shadow-md">
            <div class="p-4 text-gray-700 bg-gray-200">
                <p class="text-center font-titles font-semibold text-sm">Ingresa los datos para crear un préstamo</p >
            </div>

            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                <label for="reader" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Lector:
                </label>

                <select class="form-input w-full border border-gray-400 @error('reader') border-red-500 @enderror" 
                    name="reader" id="reader" autofocus>
                    <option value="" disabled selected>--Seleccione un lector--</option>
                    @foreach ($readers as $reader)
                        <option value="{{ $reader->id }}">
                            {{ $reader->profile->number_id }} - {{ $reader->name }}
                        </option>
                    @endforeach
                </select>

                @error('reader')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                <label for="copy" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Copia:
                </label>

                <select class="form-input w-full border border-gray-400 @error('copy') border-red-500 @enderror" 
                    name="copy" id="copy" autofocus>
                    <option value="" disabled selected>--Seleccione una copia--</option>
                    @foreach ($copies as $copy)
                        <option value="{{ $copy->id }}">
                            {{ $copy->copy_id }} - {{ $copy->book->title }} - {{ $copy->editorial }}
                        </option>
                    @endforeach
                </select>

                @error('copy')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- <div class="flex flex-wrap px-6 sm:px-10 my-6">
                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Fecha de préstamo:
                </label>

                <input id="start_date" type="date" name="start_date" value="{{ old('start_date') }}" autofocus
                    class="form-input w-full border border-gray-400 @error('start_date') border-red-500 @enderror">

                @error('start_date')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div> --}}

            <div class="flex flex-wrap px-6 sm:px-10 my-6">
                <label for="limit_date" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Fecha límite de devolución:
                </label>

                <input id="limit_date" type="date" name="limit_date" value="{{ old('limit_date') }}" autofocus
                    class="form-input w-full border border-gray-400 @error('limit_date') border-red-500 @enderror">

                @error('limit_date')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="flex justify-end p-4 sm:px-10 bg-gray-200">
                <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Guardar
                </button>
            </div>
        </div>
    </form>
@endsection