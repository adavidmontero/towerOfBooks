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
        <a href="{{ route('user.index') }}" class="font-semibold">Usuarios</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.997 18h-11.995l-.002-.623c0-1.259.1-1.986 1.588-2.33 1.684-.389 3.344-.736 2.545-2.209-2.366-4.363-.674-6.838 1.866-6.838 2.491 0 4.226 2.383 1.866 6.839-.775 1.464.826 1.812 2.545 2.209 1.49.344 1.589 1.072 1.589 2.333l-.002.619zm4.811-2.214c-1.29-.298-2.49-.559-1.909-1.657 1.769-3.342.469-5.129-1.4-5.129-1.265 0-2.248.817-2.248 2.324 0 3.903 2.268 1.77 2.246 6.676h4.501l.002-.463c0-.946-.074-1.493-1.192-1.751zm-22.806 2.214h4.501c-.021-4.906 2.246-2.772 2.246-6.676 0-1.507-.983-2.324-2.248-2.324-1.869 0-3.169 1.787-1.399 5.129.581 1.099-.619 1.359-1.909 1.657-1.119.258-1.193.805-1.193 1.751l.002.463z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Listado de Usuarios</h2>
            </div>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="py-3 px-6 font-bodies text-white bg-red-800 hover:bg-red-700 rounded-sm focus:outline-none">
                    + Nuevo
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Registro de Usuarios</h2>
                                        <small>Ingrese los datos para la creación de un nuevo usuario</small>
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
                                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Correo electrónico:
                                                </label>

                                                <input id="email" type="text"
                                                    class="form-input w-full border border-gray-400 @error('email') border-red-500 @enderror" name="email"
                                                    value="{{ old('email') }}" {{-- required --}} autocomplete="email" autofocus>

                                                @error('email')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Contraseña:
                                                </label>

                                                <input id="password" type="password"
                                                    class="form-input w-full border border-gray-400 @error('password') border-red-500 @enderror" name="password"
                                                        {{-- required --}} autofocus>

                                                @error('password')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Confirmar contraseña:
                                                </label>

                                                <input id="email" type="password"
                                                    class="form-input w-full border border-gray-400" name="password_confirmation"
                                                        {{-- required --}} autofocus>
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="roles" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Roles:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('roles') border-red-500 @enderror" 
                                                    name="roles[]" id="roles" autofocus multiple>
                                                    <option value="" disabled selected>--Seleccione uno o más roles--</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('roles')
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
                                                    <option value="" disabled selected>--Seleccione uno o más permisos--</option>
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
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
            Gestiona todos los usuarios registrados en el sistema. Como administrador y 
            secretario podrás visualizar los usuarios existentes. Además podrás agregar 
            nuevos usuarios según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($users->count())
            <div class="rounded-md overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold bg-black text-white text-left">
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Correo electrónico</th>
                            <th class="p-4">Roles</th>
                            <th class="p-4">Ver detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="font-bodies @if($loop->index % 2 === 0) bg-gray-200 @endif">
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">{{ $user->roles->pluck('display_name')->implode(', ') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('user.show', $user) }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="font-bodies my-5">
                    {{ $users->links() }}
                </div>
            </div>
        @else
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4" role="alert">
                <p class="font-bold">
                    No hay usuarios
                </p>
                <p>
                    Al parecer no hay usuarios registrados aún.
                </p>
            </div>
        @endif
    </div>
@endsection
