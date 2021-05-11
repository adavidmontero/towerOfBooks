@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="flex justify-between p-4 bg-orange-500 text-white font-bodies" x-data="{showAlert: true}" x-show="showAlert">
            <span class="mx-auto">{{ session('status') }}</span>
            <button @click="showAlert = !showAlert" class="text-center focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    @section('breadcrumb-items')
        <a href="{{ route('permission.index') }}" class="font-semibold">Permisos</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center">
            <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.303 11.315c-.007.01-.757 1.388-.872 1.604-.124.228-.494.18-.494-.118v-5.325c0-.839-1.348-.814-1.348 0v4.302c0 .235-.453.229-.453 0l-.002-5.122c0-.441-.356-.656-.714-.656-.363 0-.729.222-.729.656v5.064c0 .233-.437.243-.437.005v-4.315c0-.861-1.476-.885-1.476 0v4.571c0 .233-.472.234-.472 0v-2.845c0-.777-1.304-.821-1.304.04l-.002 6.487c.001 1.487.832 2.337 2.407 2.337h2.935c1.497 0 2.021-.846 2.438-1.693.396-.808 2.001-3.971 2.125-4.266.066-.144.095-.278.095-.401 0-.81-1.276-1.127-1.697-.325z"/></svg>
            <h2 class="font-titles font-semibold text-xl">Listado de Permisos</h2>
        </div>
        <p class="font-bodies text-justify pt-4 leading-6">
            Gestiona todos los permisos registrados en el sistema. Como administrador 
            podrás visualizar los permisos existentes. Además podrás agregar nuevos 
            permisos según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($permissions->count())
            <div class="rounded-md overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold bg-black text-white text-left">
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Nombre descriptivo</th>
                            <th class="p-4">Ver detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr class="font-bodies @if($loop->index % 2 === 0) bg-gray-200 @endif">
                                <td class="p-4">{{ $permission->name }}</td>
                                <td class="p-4">{{ $permission->display_name }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('permission.show', $permission) }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="font-bodies my-5">
                    {{ $permissions->links() }}
                </div>
            </div>
        @else
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4" role="alert">
                <p class="font-bold">
                    No hay permisos
                </p>
                <p>
                    Al parecer no hay permisos registrados aún.
                </p>
            </div>
        @endif
    </div>
@endsection
