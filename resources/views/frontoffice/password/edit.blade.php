@extends('frontoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('layouts.message', ['message' => session('success'), 'color' => 'green'])
    @elseif (session('failure'))
        @include('layouts.message', ['message' => session('failure'), 'color' => 'red'])
    @endif
@endsection

@section('content')
    <div class="my-2 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center">
            <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2 16v-8h12v-2h-14v12h14v-2h-12zm18-10v2h2v8h-2v2h4v-12h-4zm-2 12.301c0 1.699 1.359 1.621 2 1.699v1h-6v-1c.641-.078 2 0 2-1.699v-12.602c0-1.699-1.359-1.621-2-1.699v-1h6v1c-.641.078-2 0-2 1.699v12.602zm-11-6.301c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm4 0c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1z"/></svg>
            <h2 class="font-titles font-semibold text-xl">Cambio de contraseña</h2>
        </div>
        <p class="font-bodies text-justify pt-2 leading-6">
            En esta sección podrás actualizar tu contraseña siempre y cuando sepas tu contraseña actual.
        </p>
    </div>

    <form method="POST" action="{{ route('user.update_pass', $user) }}">
        @csrf
        @method('PUT')
            
        <div class="lg:w-1/2 md:min-w-max-content p-6 my-6 bg-white rounded-md shadow-md">
            <div class="p-4 text-gray-700 bg-gray-200">
                <p class="text-center font-titles font-semibold text-sm">Ingresa los datos requeridos para procesar el cambio</p >
            </div>

            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Contraseña actual:
                </label>

                <input class="form-input w-full border border-gray-400 @error('password') border-red-500 @enderror" 
                    id="password" type="password" name="password" autofocus>

                @error('password')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Nueva contraseña:
                </label>

                <input class="form-input w-full border border-gray-400 @error('new_password') border-red-500 @enderror" 
                    id="new_password" type="password" name="new_password" autofocus>

                @error('new_password')
                    <small class="text-red-500 text-xs italic mt-2">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="flex flex-wrap px-6 sm:px-10 my-6">
                <label for="new-password-confirm" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                    Confirmar contraseña:
                </label>

                <input class="form-input w-full border border-gray-400 @error('new-password-confirm') border-red-500 @enderror" 
                    id="new-password-confirm" type="password" name="new_password_confirmation" autofocus>
            </div>

            <div class="flex justify-end p-4 sm:px-10 bg-gray-200">
                <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar
                </button>
            </div>
        </div>
    </form>
@endsection
