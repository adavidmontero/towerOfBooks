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
    <a href="{{ route('loan.show', $loan) }}" class="font-semibold">Vista de préstamo</a>
@endsection

@section('content')
    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center">
            <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 12h-10v1h10v-1zm-4 2h-6v1h6v-1zm4-6h-10v1h10v-1zm0 2h-10v1h10v-1zm0-6h-10v1h10v-1zm0 2h-10v1h10v-1zm7.44 10.277c.183-2.314-.433-2.54-3.288-5.322.171 1.223.528 3.397.911 5.001.089.382-.416.621-.586.215-.204-.495-.535-2.602-.82-4.72-.154-1.134-1.661-.995-1.657.177.005 1.822.003 3.341 0 6.041-.003 2.303 1.046 2.348 1.819 4.931.132.444.246.927.339 1.399l3.842-1.339c-1.339-2.621-.693-4.689-.56-6.383zm-6.428 1.723h-13.012v-16h14v7.894c.646-.342 1.348-.274 1.877.101l.123-.018v-8.477c0-.828-.672-1.5-1.5-1.5h-15c-.828 0-1.5.671-1.5 1.5v17c0 .829.672 1.5 1.5 1.5h13.974c-.245-.515-.425-1.124-.462-2z"/></svg>
            <h2 class="font-titles font-semibold text-xl">Vista de préstamo</h2>
        </div>
        <p class="font-bodies text-justify pt-2 leading-6">
            En esta sección podrás asignar un préstamo de una copia a un lector, teniendo en cuenta una fecha
            inicial y una fecha límite en la que se espera que hagan la devolución. Si no es entregado antes 
            de tal fecha el lector será sancionado.
        </p>
    </div>

    <div class="my-6 grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="col-span-2 bg-white rounded-md shadow-md p-4">
            <div class="p-4 bg-gray-200 text-center font-titles text-gray-900 font-semibold uppercase mb-4">
                <p>Datos del préstamo</p>
            </div>
            <div class="md:flex gap-4 mb-0 md:mb-2">
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Fecha de inicio</h2>
                    <p class="p-4">{{ $loan->start_date }}</p>
                </div>
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Fecha límite</h2>
                    <p class="p-4">{{ $loan->limit_date }}</p>
                </div>
            </div>
            <div class="md:flex gap-4 mb-0 md:mb-2">
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Fecha de devolución</h2>
                    <p class="p-4">
                        @if ($loan->devolution_date)
                            {{ $loan->devolution_date }}
                        @else
                            Pendiente
                        @endif
                    </p>
                </div>
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Estado</h2>
                    @if($loan->devolution_date) 
                        <p class="inline-block my-3 px-2 py-1 text-xs bg-green-200 text-green-800 font-semibold rounded-lg">
                            Finalizada
                        </p>
                    @else
                        <p class="inline-block my-3 px-2 py-1 text-xs bg-orange-200 text-orange-800 font-semibold rounded-lg">
                            En proceso
                        </p>
                    @endif
                </div>
            </div>
            <div class="md:flex gap-4 mb-0 md:mb-2">
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Copia</h2>
                    <p class="py-4">{{ $loan->copy->copy_id }} - {{ $loan->copy->book->title }}</p>
                </div>
                <div class="w-full text-center">
                    <h2 class="p-2 font-titles font-semibold text-gray-700 bg-gray-200">Lector</h2>
                    <div>
                        <p class="p-4">{{ $loan->user->profile->number_id }} - {{ $loan->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if (!$loan->devolution_date)
            <div class="bg-white rounded-md shadow-md p-4">
                <div class="p-4 bg-gray-200 text-center font-titles text-gray-900 font-semibold uppercase">
                    <p>Opciones</p>
                </div>
                <div class="mt-6 text-center text-sm text-gray-900 font-semibold font-titles">
                    <div x-data="{ modalOpen: false }">
                        <button @click="modalOpen = !modalOpen" class="block w-full font-semibold p-4 border-b border-gray-200 hover:bg-gray-200">REGISTRAR DEVOLUCIÓN</button>
                        <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
                            <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                            </div>
                            <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10 z-50">
                                <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <div class="flex items-center justify-center p-4 rounded-t-lg text-gray-700 bg-red-900">
                                        <p class="font-logo font-normal normal-case text-3xl text-white">{{ config('app.name', 'Laravel') }}</p>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <h2 class="font-semibold normal-case">¿Deseas registrar la devolución de este libro?</h2>
                                    </div>
                                    <div class="md:flex gap-4 p-4 rounded-b-lg bg-gray-200">
                                        <a href="{{ route('loan.update_devolution', $loan) }}" onclick="event.preventDefault(); document.getElementById('devolution-form').submit();"
                                            class="block w-full md:w-1/2 normal-case rounded-md shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                            Sí
                                        </a>
                                        <button @click="modalOpen = !modalOpen" type="button" class="w-full md:w-1/2 mt-2 md:mt-0 rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium text-gray-900 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                            No
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="devolution-form" action="{{ route('loan.update_devolution', $loan) }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                            @method('PUT')
                        </form>
                    </div>
                    <form id="devolution-form" action="{{ route('loan.update_devolution', $loan) }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                        @method('PUT')
                    </form>
                    <div x-data="{ modalOpenTwo: false }">
                        <button @click="modalOpenTwo = !modalOpenTwo" class="block w-full font-semibold p-4 border-b border-gray-200 hover:bg-gray-200">CANCELAR PRÉSTAMO</button>
                        <div x-show.transition.opacity="modalOpenTwo" class="fixed top-0 left-0 w-full h-full">
                            <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
                            </div>
                            <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10 z-50">
                                <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <div class="flex items-center justify-center p-4 rounded-t-lg text-gray-700 bg-red-900">
                                        <p class="font-logo font-normal normal-case text-3xl text-white">{{ config('app.name', 'Laravel') }}</p>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <h2 class="font-semibold normal-case">¿Deseas cancelar este préstamo?</h2>
                                    </div>
                                    <div class="md:flex gap-4 p-4 rounded-b-lg bg-gray-200">
                                        <a href="{{ route('loan.destroy', $loan) }}" onclick="event.preventDefault(); document.getElementById('cancel-loan-form').submit();"
                                            class="block w-full md:w-1/2 normal-case rounded-md shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                            Sí
                                        </a>
                                        <button @click="modalOpenTwo = !modalOpenTwo" type="button" class="w-full md:w-1/2 mt-2 md:mt-0 rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium text-gray-900 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                            No
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="cancel-loan-form" action="{{ route('loan.destroy', $loan) }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection