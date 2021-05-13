@extends('backoffice.layouts.app')

@section('status')
    @if (session('status'))
        <div class="flex justify-between p-4 bg-orange-500 text-white font-bodies" x-data="{showAlert: true}" x-show="showAlert">
            <span class="mx-auto">{{ session('status') }}</span>
            <button @click="showAlert = !showAlert" class="text-center focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('role.index') }}">Roles</a>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg>
        <a href="{{ route('role.show', $role) }}" class="font-semibold">Vista del rol</a>
    @endsection

    <div class="my-6 px-2 md:px-8 py-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between mb-5 p-6 text-gray-700 bg-gray-200">
            <h2 class="self-center font-titles font-semibold text-xl">Datos del rol: {{ $role->display_name }}</h2>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="flex py-3 px-4 font-bodies text-white bg-orange-500 hover:bg-orange-600 rounded-sm focus:outline-none">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('role.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Edición de Roles</h2>
                                        <small>Cambia los datos si deseas actualizar este rol</small>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <div class="p-4">
                                            <div class="flex flex-wrap px-6 sm:px-10">
                                                <label for="display_name" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Nombre Descriptivo:
                                                </label>

                                                <input id="display_name" type="text"
                                                    class="form-input w-full border border-gray-400 @error('display_name') border-red-500 @enderror" name="display_name"
                                                    value="{{ $role->display_name ?? old('display_name') }}" autocomplete="display_name" autofocus>

                                                @error('display_name')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="permissions" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Permisos:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('permissions') border-red-500 @enderror" 
                                                    name="permissions[]" id="permissions" autofocus multiple>
                                                    <option value="">--Ningún permiso--</option>
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}" {{ ($role->permissions->contains($permission->id)) ? 'selected' : '' }}>
                                                            {{ $permission->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('permissions')
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
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Nombre</h2>
                <p class="p-4">{{ $role->name }}</p>
            </div>
            <div class="w-full text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Nombre Descriptivo</h2>
                <p class="p-4">{{ $role->display_name }}</p>
            </div>
        </div>
        <div class="w-full text-center">
            <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Permisos de este rol</h2>
            @forelse ($role->permissions as $permission)
                <span class="inline-block p-2 mt-4 text-gray-700 bg-gray-200 rounded-sm">
                    {{ $permission->display_name }}
                </span>
            @empty
                <span class="block p-2 mt-4 text-red-700 font-semibold bg-red-200">
                    Este rol no cuenta con permisos
                </span>
            @endforelse
        </div>
    </div>
@endsection
