@extends('frontoffice.layouts.app')

@section('content')
    <div class="my-2 bg-white rounded-md shadow-md p-4">
        <header class="p-4 bg-gray-200 text-center font-titles text-gray-900 font-semibold uppercase">
            <h1>Copias de la biblioteca</h1>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4 font-bodies">
            @forelse ($copies as $copy)
                <div class="px-4 py-2">
                    <a class="block rounded overflow-hidden">
                        <img src="{{ asset($copy->image_url) }}" class="object-cover object-center w-full h-full block border border-gray-400">
                    </a>
                    <div class="mt-4">
                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ $copy->book->genre->name }}</h3>
                        <h2 class="text-gray-900 title-font text-sm font-semibold">{{ $copy->book->title }}</h2>
                        @if($copy->state === 'Disponible') 
                            <p class="inline-block mt-1 px-2 py-1 text-xs bg-green-200 text-green-800 font-semibold rounded-lg">
                                {{ $copy->state }}
                            </p>
                        @else
                            <p class="inline-block mt-1 px-2 py-1 text-xs bg-gray-200 text-gray-800 font-semibold rounded-lg">
                                {{ $copy->state }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-2 px-4 leading-6 bg-red-200 border-red-600 text-red-600 border-l-4" role="alert">
                    <p class="font-bold">
                        No hay copias
                    </p>
                    <p>
                        Al parecer no hay copias registradas aún.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
