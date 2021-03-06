<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Font Logo -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <!-- Other Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bitter&display=swap" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="w-full relative h-auto md:top-0 md:fixed md:h-20 bg-red-900 py-5 space-x-4">
            <div class="container mx-auto flex justify-between items-center px-4 md:px-0">
                <div>
                    <a href="{{ url('/') }}" class="flex items-center font-logo text-3xl text-white pl-5">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base pr-5">
                    @guest
                        <a class="text-white hover:text-gray-300" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="text-white hover:text-gray-300" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="flex items-center font-titles">
                            <div class="flex justify-center">
                                <div x-data="{ dropdownOpen: false }" class="relative">
                                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center rounded-sm bg-white text-sm font-semibold text-black p-2 hover:text-red-900 focus:outline-none">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                                    <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-sm shadow-xl z-20">
                                        {{-- <a href="#" class="block px-4 py-2 text-sm capitalize text-black hover:bg-red-500 hover:text-white">
                                            Mi perfil
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm capitalize text-black hover:bg-red-500 hover:text-white">
                                            Your projects
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm capitalize text-black hover:bg-red-500 hover:text-white">
                                            Help
                                        </a>
                                        <a href="#" class="block px-4 py-2 text-sm capitalize text-black hover:bg-red-500 hover:text-white">
                                            Settings
                                        </a> --}}
                                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-red-500 hover:text-white"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Cerrar sesi??n
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endguest
                </nav>
            </div>
        </header>

        <div class="md:flex">
            @include('backoffice.layouts.sidebar')

            <main class="md:ml-72 p-4 w-full h-full md:mt-20">
                @yield('status')

                @include('layouts.breadcrumbs')

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
