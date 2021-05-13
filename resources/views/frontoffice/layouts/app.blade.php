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
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-red-900 py-5">
            <div class="container mx-auto flex justify-between items-center px-4">
                <div>
                    <a href="{{ url('/book') }}" class="flex items-center font-logo text-3xl text-white">
                        <img src="{{ asset('./images/2909611-ffffff.svg') }}" class="w-10 h-10 -mt-2">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="text-white hover:text-gray-300" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="text-white hover:text-gray-300" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @endguest
                </nav>
            </div>
        </header>

        @yield('status')
        
        <div class="md:flex">

            @include('frontoffice.layouts.sidebar')
    
            <main class="w-full md:w-4/5 p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
