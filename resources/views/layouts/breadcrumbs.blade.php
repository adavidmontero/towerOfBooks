<div class="bg-white rounded-md shadow-md p-4">
    <div class="flex items-center space-x-2 text-sm font-bodies">
        <a href="{{ route('home.index') }}">Inicio</a>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg>
        {{-- <a href="{{ route('') }}"></a>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.122 24l-4.122-4 8-8-8-8 4.122-4 11.878 12z"/></svg> --}}
        @yield('breadcrumb-items')
    </div>
</div>