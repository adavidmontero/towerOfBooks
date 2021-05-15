@extends('backoffice.layouts.app')

@section('content')
    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <header class="p-4 bg-gray-200 text-center font-titles text-gray-900 font-semibold uppercase">
            <h1>Panel de Aministración</h1>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 font-bodies text-center text-gray-900 mt-4">
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $users }}</h2>
                    <p class="leading-relaxed font-semibold">Usuarios</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $roles }}</h2>
                    <p class="leading-relaxed font-semibold">Roles</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $permissions }}</h2>
                    <p class="leading-relaxed font-semibold">Permisos</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $copies }}</h2>
                    <p class="leading-relaxed font-semibold">Ejemplares</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $books }}</h2>
                    <p class="leading-relaxed font-semibold">Libros</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $authors }}</h2>
                    <p class="leading-relaxed font-semibold">Autores</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $genres }}</h2>
                    <p class="leading-relaxed font-semibold">Géneros</p>
                </div>
            </div>
            <div class="flex items-center justify-around p-4 bg-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                <div>
                    <h2 class="title-font font-medium sm:text-4xl text-3xl">{{ $categories }}</h2>
                    <p class="leading-relaxed font-semibold">Subgéneros</p>
                </div>
            </div>
        </div>
    </div>
    <div class="my-6 bg-white rounded-md shadow-md p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {!! $chart->container() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ LarapexChart::cdn() }}"></script>
    {{ $chart->script() }}
@endsection
