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
        {{-- <header class="bg-red-900 py-4 shadow-md">
            <div class="container mx-auto flex justify-center">
                <a href="{{ url('/reader') }}" class="flex items-center font-logo text-3xl text-white">
                    <img src="{{ asset('./images/2909611-ffffff.svg') }}" class="w-10 h-10 -mt-1">
                    {{ config('app.name', 'Laravel') }}
                    <img src="{{ asset('./images/2909611-ffffff.svg') }}" class="w-10 h-10 -mt-1">
                </a>
            </div>
        </header> --}}

        @yield('status')
        
        <div>
            @include('frontoffice.layouts.sidebar')
    
            <main class="md:ml-72 px-4 py-4 h-full md:mt-2">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
