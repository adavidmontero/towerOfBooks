<aside class="w-full relative h-auto md:fixed md:w-72 md:top-0 md:h-full bg-white uppercase text-black text-sm font-semibold font-titles shadow-md">
    <div class="flex justify-center items-center py-2 md:py-4 px-4 font-logo font-normal normal-case text-3xl bg-red-900 text-white text-center shadow-md">
        {{ config('app.name', 'Laravel') }}
    </div>
    <hr>
    <div class="flex justify-center items-center gap-4 py-4 md:py-6 px-2 text-center">
        <img src="{{ asset(Auth::user()->profile->image_url) }}" class="w-16 h-16 md:w-20 md:h-20 rounded-full border border-gray-400" />
        <div>
            <p>{{ Auth::user()->name }}</p>
            <small class="font-normal capitalize">{{ Auth::user()->roles->pluck('display_name')->first() }}</small>
        </div>
    </div>
    <hr>
    <a href="/reader" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        Inicio
    </a>
    <a href="#" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
        Mis solicitudes
    </a>
    <a href="#" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 16.78c.002-1.8.003-2.812 0-4.027-.001-.417.284-.638.567-.638.246 0 .49.168.538.52.19 1.412.411 2.816.547 3.146.042.099.113.141.185.141.123 0 .244-.123.206-.284-.255-1.069-.493-2.519-.607-3.334 1.904 1.854 2.314 2.005 2.192 3.548-.089 1.129-.52 2.508.373 4.255l-2.563.893c-.062-.314-.138-.637-.226-.933-.515-1.721-1.214-1.752-1.212-3.287zm-16.567-4.665c-.246 0-.49.168-.538.52-.19 1.412-.411 2.816-.547 3.146-.042.099-.113.141-.185.141-.123 0-.244-.123-.206-.284.255-1.069.493-2.519.607-3.334-1.904 1.854-2.314 2.005-2.192 3.548.09 1.128.521 2.507-.372 4.254l2.562.894c.062-.314.138-.637.226-.933.515-1.721 1.214-1.752 1.212-3.287-.002-1.8-.003-2.812 0-4.027.001-.418-.285-.638-.567-.638zm1.567.642zm14.001 2.637c-2.354.194-4.35.62-6.001 1.245v-9.876l.057-.036c1.311-.816 3.343-1.361 5.943-1.603v7.633c-.002-.459.165-.881.469-1.186.377-.378.947-.562 1.531-.391v-8.18c-3.438.105-6.796.658-9 2.03-2.204-1.372-5.562-1.925-9-2.03v8.18c.583-.17 1.153.012 1.531.391.304.305.471.726.469 1.184v-7.631c2.6.242 4.632.788 5.943 1.604l.057.035v9.876c-1.651-.626-3.645-1.052-6-1.246v1.385c0 .234-.021.431-.046.622 2.249.193 4.372.615 6.046 1.381.638.292 1.362.291 2 0 1.675-.766 3.798-1.188 6.046-1.381-.025-.191-.046-.386-.046-.621l.001-1.385zm-12.001-2.426c1.088.299 2.122.64 3 .968v1.064c-.823-.345-1.879-.705-3-1.015v-1.017zm0-1.014c1.121.31 2.177.67 3 1.015v-1.064c-.878-.328-1.912-.669-3-.968v1.017zm0-5.09v1.017c1.121.311 2.177.67 3 1.015v-1.064c-.878-.328-1.912-.669-3-.968zm0 3.058c1.121.31 2.177.67 3 1.015v-1.063c-.878-.328-1.912-.669-3-.968v1.016zm10 4.063c-1.121.31-2.177.67-3 1.015v-1.064c.878-.328 1.912-.669 3-.968v1.017zm0-3.048c-1.088.299-2.122.64-3 .968v1.064c.823-.345 1.879-.705 3-1.015v-1.017zm-3-3.105v1.064c.823-.345 1.879-.705 3-1.015v-1.017c-1.088.299-2.122.64-3 .968zm3 1.074c-1.088.299-2.122.64-3 .968v1.064c.823-.345 1.879-.705 3-1.015v-1.017z"/></svg>
        Mis préstamos
    </a>
    <a href="#" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.84 14.31c-.295.522-.517 1.09-.659 1.69h-9.181v-.417c-.004-1.112.044-1.747 1.324-2.043 1.402-.324 2.787-.613 2.121-1.841-1.972-3.637-.562-5.699 1.555-5.699 2.077 0 3.521 1.985 1.556 5.699-.647 1.22.688 1.51 2.121 1.841.672.155 1 .407 1.163.77zm-.815 3.69h-11.025v-14h20v7.5c.749.312 1.424.763 2 1.316v-10.816h-24v18h13.5c-.26-.623-.421-1.296-.475-2zm6.975-9h-4v2h4v-2zm-4-1h4v-2h-4v2zm8 9.5c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-3.086-2.122l-1.414 1.414-1.414-1.414-.707.708 1.414 1.414-1.414 1.414.707.708 1.414-1.414 1.414 1.414.708-.708-1.414-1.414 1.414-1.414-.708-.708z"/></svg>
        Mis sanciones
    </a>
    <a href="{{ route('profile.show', Auth::user()->profile) }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z"/></svg>
        Mi perfil
    </a>
    <a href="{{ route('user.edit_pass', Auth::user()) }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 17c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm3 0c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm3 0c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm2-7v-4c0-3.313-2.687-6-6-6s-6 2.687-6 6v4h-3v14h18v-14h-3zm-10-4c0-2.206 1.795-4 4-4s4 1.794 4 4v4h-8v-4zm11 16h-14v-10h14v10z"/></svg>
        Modificar contraseña
    </a>
    <div x-data="{ modalOpen: false }">
        <button @click="modalOpen = !modalOpen" class="flex w-full px-4 py-3 text-center uppercase text-black text-sm font-semibold font-titles hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200 focus:outline-none">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14 12h-4v-12h4v12zm4.213-10.246l-1.213 1.599c2.984 1.732 5 4.955 5 8.647 0 5.514-4.486 10-10 10s-10-4.486-10-10c0-3.692 2.016-6.915 5-8.647l-1.213-1.599c-3.465 2.103-5.787 5.897-5.787 10.246 0 6.627 5.373 12 12 12s12-5.373 12-12c0-4.349-2.322-8.143-5.787-10.246z"/></svg>
            Cerrar sesión
        </button>
        <div x-show.transition.opacity="modalOpen" class="fixed top-0 left-0 w-full h-full">
            <div class="absolute w-full h-full inset-0 bg-gray-600 opacity-75">
            </div>
            <div class="flex items-center justify-center h-screen pt-4 px-4 pb-20 font-bodies text-center my-10 z-50">
                <div class="w-full transform transition-all md:w-2/3 lg:w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="flex items-center justify-center p-4 rounded-t-lg text-gray-700 bg-red-900">
                        <p class="font-logo font-normal normal-case text-3xl text-white">{{ config('app.name', 'Laravel') }}</p>
                    </div>
                    <div class="p-4 bg-white">
                        <h2 class="font-semibold normal-case">¿Deseas salir de la aplicación?</h2>
                    </div>
                    <div class="md:flex gap-4 p-4 rounded-b-lg bg-gray-200">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            {{ csrf_field() }}
        </form>
    </div>
</aside>