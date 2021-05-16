@extends('frontoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('frontoffice.layouts.message', ['message' => session('success'), 'color' => 'orange'])
    @endif
@endsection

@section('content')
    <div class="my-2 bg-white rounded-md shadow-md p-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2.033 16.01c.564-1.789 1.632-3.932 1.821-4.474.273-.787-.211-1.136-1.74.209l-.34-.64c1.744-1.897 5.335-2.326 4.113.613-.763 1.835-1.309 3.074-1.621 4.03-.455 1.393.694.828 1.819-.211.153.25.203.331.356.619-2.498 2.378-5.271 2.588-4.408-.146zm4.742-8.169c-.532.453-1.32.443-1.761-.022-.441-.465-.367-1.208.164-1.661.532-.453 1.32-.442 1.761.022.439.466.367 1.209-.164 1.661z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Información personal</h2>
            </div>
            <!-- Start Modal -->
            <div x-data="{ @if($errors->any()) modalOpen: true @else modalOpen: false @endif }">
                <button @click="modalOpen = !modalOpen" class="flex py-3 px-4 font-bodies text-white bg-orange-500 hover:bg-orange-600 rounded-sm focus:outline-none">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar
                </button>
                <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                    <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                    </div>
                    <form method="POST" action="{{ route('profile.update', $profile) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10">
                            <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div>
                                    <div class="p-6 rounded-t-lg text-gray-700 bg-gray-200">
                                        <h2 class="font-titles font-semibold mb-2">Edición de perfil</h2>
                                        <small>Cambie los datos para actualizar su perfil</small>
                                    </div>
                                    <div class="p-4 bg-white h-56 md:h-96 overflow-y-auto">
                                        <div class="p-4">
                                            <div class="flex flex-wrap px-6 sm:px-10">
                                                <label for="type_id" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Tipo de documento:
                                                </label>

                                                <select class="form-input w-full border border-gray-400 @error('type_id') border-red-500 @enderror" 
                                                    name="type_id" id="type_id" autofocus>
                                                    <option value="" disabled selected>--Seleccione tipo de documento--</option>
                                                    <option value="TI" {{ ($profile->type_id === 'TI') ? 'selected' : '' }}>Tarjeta de identidad</option>
                                                    <option value="CC" {{ ($profile->type_id === 'CC') ? 'selected' : '' }}>Cédula de ciudadanía</option>
                                                    <option value="CE" {{ ($profile->type_id === 'CE') ? 'selected' : '' }}>Cédula de extranjería</option>
                                                    <option value="PA" {{ ($profile->type_id === 'PA') ? 'selected' : '' }}>Pasaporte</option>
                                                </select>

                                                @error('type_id')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="number_id" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Número de documento:
                                                </label>

                                                <input id="number_id" type="number" value="{{ $profile->number_id ?? old('number_id') }}" name="number_id" autofocus
                                                    class="form-input w-full border border-gray-400 @error('number_id') border-red-500 @enderror">

                                                @error('number_id')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Teléfono personal:
                                                </label>

                                                <input id="telephone" type="number" value="{{ $profile->telephone ?? old('telephone') }}" name="telephone" autofocus
                                                    class="form-input w-full border border-gray-400 @error('telephone') border-red-500 @enderror">

                                                @error('telephone')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="address" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Dirección de residencia:
                                                </label>

                                                <input id="address" type="text"
                                                    class="form-input w-full border border-gray-400 @error('address') border-red-500 @enderror" name="address"
                                                    value="{{ $profile->address ?? old('address') }}" autocomplete="address" autofocus>
                                            
                                                @error('address')
                                                    <small class="text-red-500 text-xs italic mt-2">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Descripción personal:
                                                </label>

                                                <textarea class="form-input w-full border border-gray-400 @error('description') border-red-500 @enderror"
                                                    name="description" id="description" rows="4" autocomplete="description" autofocus>{{ $profile->description ?? old('description') }}</textarea>
                                            </div>

                                            <div class="flex flex-wrap px-6 sm:px-10 mt-6">
                                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2 md:mb-1">
                                                    Imagen <span class="font-normal">(Las dimensiones deben ser mayor a 500px)</span> :
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
        <p class="font-bodies text-justify pt-2 leading-6">
            El usuario podrá visualizar y actualizar toda su información personal y de contacto.
        </p>
    </div>

    <div class="lg:flex gap-4 my-6">
        <div class="w-full lg:w-1/3 my-6 lg:my-0 px-4 py-6 bg-white rounded-md shadow-md">
            <div class="text-center mb-2">
                <h2 class="p-2 mb-4 font-titles font-semibold text-gray-700 bg-gray-200">Foto de perfil</h2>
                <div>
                    <img class="w-16 h-16 lg:w-20 lg:h-20 mx-auto rounded-full border border-gray-400" 
                        src="{{ asset($profile->image_url) }}" alt="profile_photo">
                </div>
            </div>
            <div class="text-center mb-2">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Nombre completo</h2>
                <p class="p-4">{{ $profile->user->name }}</p>
            </div>
            <div class="text-center mb-2">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Correo electrónico</h2>
                <p class="p-4">{{ $profile->user->email }}</p>
            </div>
        </div>

        <div class="w-full lg:w-2/3 px-4 py-6 bg-white rounded-md shadow-md">
            <div class="lg:flex gap-4 mb-0 lg:mb-2">
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Tipo de documento</h2>
                    <p class="p-4">{{ $profile->type_id }}</p>
                </div>
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Número de documento</h2>
                    <p class="p-4">{{ $profile->number_id }}</p>
                </div>
            </div>
            <div class="lg:flex gap-4 mb-0 lg:mb-2">
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Dirección de residencia</h2>
                    <p class="p-4">{{ $profile->address }}</p>
                </div>
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Teléfono</h2>
                    <p class="p-4">{{ $profile->telephone }}</p>
                </div>
            </div>
            <div class="text-center">
                <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Descripción</h2>
                <p class="px-2 py-4 text-justify leading-6">{{ $profile->description }}</p>
            </div>
        </div>
    </div>
@endsection
