@extends('backoffice.layouts.app')

@section('status')
    @if (session('success'))
        @include('backoffice.layouts.message', ['message' => session('success'), 'color' => 'green'])
    @endif
@endsection

@section('content')
    @section('breadcrumb-items')
        <a href="{{ route('loan.index') }}" class="font-semibold">Préstamos</a>
    @endsection

    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 12h-10v1h10v-1zm-4 2h-6v1h6v-1zm4-6h-10v1h10v-1zm0 2h-10v1h10v-1zm0-6h-10v1h10v-1zm0 2h-10v1h10v-1zm7.44 10.277c.183-2.314-.433-2.54-3.288-5.322.171 1.223.528 3.397.911 5.001.089.382-.416.621-.586.215-.204-.495-.535-2.602-.82-4.72-.154-1.134-1.661-.995-1.657.177.005 1.822.003 3.341 0 6.041-.003 2.303 1.046 2.348 1.819 4.931.132.444.246.927.339 1.399l3.842-1.339c-1.339-2.621-.693-4.689-.56-6.383zm-6.428 1.723h-13.012v-16h14v7.894c.646-.342 1.348-.274 1.877.101l.123-.018v-8.477c0-.828-.672-1.5-1.5-1.5h-15c-.828 0-1.5.671-1.5 1.5v17c0 .829.672 1.5 1.5 1.5h13.974c-.245-.515-.425-1.124-.462-2z"/></svg>
                <h2 class="font-titles font-semibold text-xl">Listado de Préstamos</h2>
            </div>
            <a href="{{ route('loan.create') }}" class="py-3 px-6 font-bodies text-white bg-red-800 hover:bg-red-700 rounded-sm focus:outline-none">
                + Nuevo
            </a>
        </div>
        <p class="font-bodies text-justify pt-4 leading-6">
            Gestiona todos los préstamos registrados en el sistema. Como administrador y 
            secretario podrás visualizar los préstamos existentes. Además podrás agregar 
            nuevos préstamos según lo requieras.
        </p>
    </div>

    <div class="px-2 my-6 md:px-8 py-6 bg-white rounded-md shadow-md">
        @if ($loans->count())
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="font-titles font-semibold text-gray-700 bg-gray-200 text-left">
                            <th class="p-4 rounded-tl-sm">Copia</th>
                            <th class="p-4">Fecha de préstamo</th>
                            <th class="p-4">Fecha límite de devolución</td>
                            <th class="p-4">Estado</td>
                            <th class="p-4 text-center rounded-tr-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr class="font-bodies border-b border-gray-200">
                                <td class="p-4">{{ $loan->copy->book->title }}</td>
                                <td class="p-4">{{ $loan->start_date }}</td>
                                <td class="p-4">{{ $loan->limit_date }}</td>
                                <td class="p-4">
                                    @if($loan->devolution_date) 
                                        <p class="inline-block mt-1 px-2 py-1 text-xs bg-green-200 text-green-800 font-semibold rounded-lg">
                                            Finalizada
                                        </p>
                                    @else
                                        <p class="inline-block mt-1 px-2 py-1 text-xs bg-orange-200 text-orange-800 font-semibold rounded-lg">
                                            En proceso
                                        </p>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('loan.show', $loan) }}" class="">
                                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="font-bodies my-5">
                    {{ $loans->links() }}
                </div>
            </div>
        @else
            <div class="p-2 px-4 leading-6 bg-red-200 border-red-600 text-red-600 border-l-4" role="alert">
                <p class="font-bold">
                    No hay préstamos
                </p>
                <p>
                    Al parecer no hay préstamos por aquí.
                </p>
            </div>
        @endif
    </div>
@endsection
