<aside class="w-full md:w-1/4 lg:w-1/5 min-h-screen bg-white uppercase text-black text-sm font-semibold font-titles shadow-md">
    <div class="py-6 md:py-8 px-4 text-center">
        <p>{{ Auth::user()->name }}</p>
        <small class="font-normal capitalize">{{ Auth::user()->roles->pluck('display_name')->first() }}</small>
    </div>
    <hr>
    <a href="{{ route('home.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        Inicio
    </a>
    <a href="{{ route('user.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2 hover:bg-red-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.997 18h-11.995l-.002-.623c0-1.259.1-1.986 1.588-2.33 1.684-.389 3.344-.736 2.545-2.209-2.366-4.363-.674-6.838 1.866-6.838 2.491 0 4.226 2.383 1.866 6.839-.775 1.464.826 1.812 2.545 2.209 1.49.344 1.589 1.072 1.589 2.333l-.002.619zm4.811-2.214c-1.29-.298-2.49-.559-1.909-1.657 1.769-3.342.469-5.129-1.4-5.129-1.265 0-2.248.817-2.248 2.324 0 3.903 2.268 1.77 2.246 6.676h4.501l.002-.463c0-.946-.074-1.493-1.192-1.751zm-22.806 2.214h4.501c-.021-4.906 2.246-2.772 2.246-6.676 0-1.507-.983-2.324-2.248-2.324-1.869 0-3.169 1.787-1.399 5.129.581 1.099-.619 1.359-1.909 1.657-1.119.258-1.193.805-1.193 1.751l.002.463z"/></svg>
        Usuarios
    </a>
    @if (auth()->user()->hasRole('Admin'))
        <a href="{{ route('role.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.313 5.998c.242.216.473.445.687.688l-1.165 1.166-.332-.356-.356-.331 1.166-1.167zm-2.653-1.56c.308.107.608.234.897.378l-.643 1.52c-.167-.088-.341-.168-.52-.239l-.373-.14.639-1.519zm-3.146-.438h.973v1.648l-.487-.018-.486.019v-1.649zm-2.125.419l.631 1.524-.416.153c-.165.067-.326.141-.483.22l-.63-1.524c.288-.142.59-.267.898-.373zm.716 6.829l1.045-1.045-1.463-1.466c.652-.464 1.451-.738 2.313-.738 2.21 0 4 1.791 4 4.001 0 2.209-1.79 3.999-4 3.999s-4-1.79-4-3.999c0-.813.242-1.567.658-2.199l1.447 1.447zm-3.418-5.25l1.167 1.166-.357.331-.332.357-1.165-1.166c.214-.243.445-.472.687-.688zm-1.871 2.443l1.52.641c-.087.168-.168.343-.238.52l-.14.376-1.52-.641c.109-.309.235-.608.378-.896zm-.816 3.07h1.649l-.019.485.019.486h-1.649v-.971zm.42 3.094l1.524-.63.153.417.219.48-1.524.632c-.141-.289-.266-.59-.372-.899zm2.13 3.527l-.688-.687 1.303-1.304.332.356.356.331-1.303 1.304zm2.79 1.43c-.308-.108-.608-.234-.897-.379l.643-1.52c.167.088.341.169.52.239l.375.14-.641 1.52zm3.146.438h-.973v-1.649l.486.019.486-.019v1.649zm2.124-.42l-.63-1.525.415-.152c.165-.066.326-.14.483-.22l.63 1.523c-.287.143-.589.268-.898.374zm2.703-1.586l-1.167-1.165.356-.331.332-.356 1.166 1.165c-.214.244-.445.473-.687.687zm1.871-2.441l-1.521-.643c.087-.168.169-.341.239-.518l.14-.378 1.52.642c-.109.307-.235.608-.378.897zm.816-3.071h-1.649l.019-.486-.019-.485h1.649v.971zm-1.944-2.464l-.153-.416-.219-.483 1.524-.629c.141.288.266.59.372.897l-1.524.631zm-6.056-8.018c5.514 0 10 4.486 10 10s-4.486 9.999-10 9.999-10-4.485-10-9.999 4.486-10 10-10zm0-2c-6.632 0-12 5.366-12 12 0 6.631 5.367 11.999 12 11.999 6.632 0 12-5.366 12-11.999 0-6.632-5.367-12-12-12z"/></svg>
            Roles
        </a>
        <a href="{{ route('permission.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.303 11.315c-.007.01-.757 1.388-.872 1.604-.124.228-.494.18-.494-.118v-5.325c0-.839-1.348-.814-1.348 0v4.302c0 .235-.453.229-.453 0l-.002-5.122c0-.441-.356-.656-.714-.656-.363 0-.729.222-.729.656v5.064c0 .233-.437.243-.437.005v-4.315c0-.861-1.476-.885-1.476 0v4.571c0 .233-.472.234-.472 0v-2.845c0-.777-1.304-.821-1.304.04l-.002 6.487c.001 1.487.832 2.337 2.407 2.337h2.935c1.497 0 2.021-.846 2.438-1.693.396-.808 2.001-3.971 2.125-4.266.066-.144.095-.278.095-.401 0-.81-1.276-1.127-1.697-.325z"/></svg>
            Permisos
        </a>
    @endif
    <a href="{{ route('copy.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 16.78c.002-1.8.003-2.812 0-4.027-.001-.417.284-.638.567-.638.246 0 .49.168.538.52.19 1.412.411 2.816.547 3.146.042.099.113.141.185.141.123 0 .244-.123.206-.284-.255-1.069-.493-2.519-.607-3.334 1.904 1.854 2.314 2.005 2.192 3.548-.089 1.129-.52 2.508.373 4.255l-2.563.893c-.062-.314-.138-.637-.226-.933-.515-1.721-1.214-1.752-1.212-3.287zm-16.567-4.665c-.246 0-.49.168-.538.52-.19 1.412-.411 2.816-.547 3.146-.042.099-.113.141-.185.141-.123 0-.244-.123-.206-.284.255-1.069.493-2.519.607-3.334-1.904 1.854-2.314 2.005-2.192 3.548.09 1.128.521 2.507-.372 4.254l2.562.894c.062-.314.138-.637.226-.933.515-1.721 1.214-1.752 1.212-3.287-.002-1.8-.003-2.812 0-4.027.001-.418-.285-.638-.567-.638zm1.567.642zm14.001 2.637c-2.354.194-4.35.62-6.001 1.245v-9.876l.057-.036c1.311-.816 3.343-1.361 5.943-1.603v7.633c-.002-.459.165-.881.469-1.186.377-.378.947-.562 1.531-.391v-8.18c-3.438.105-6.796.658-9 2.03-2.204-1.372-5.562-1.925-9-2.03v8.18c.583-.17 1.153.012 1.531.391.304.305.471.726.469 1.184v-7.631c2.6.242 4.632.788 5.943 1.604l.057.035v9.876c-1.651-.626-3.645-1.052-6-1.246v1.385c0 .234-.021.431-.046.622 2.249.193 4.372.615 6.046 1.381.638.292 1.362.291 2 0 1.675-.766 3.798-1.188 6.046-1.381-.025-.191-.046-.386-.046-.621l.001-1.385zm-12.001-2.426c1.088.299 2.122.64 3 .968v1.064c-.823-.345-1.879-.705-3-1.015v-1.017zm0-1.014c1.121.31 2.177.67 3 1.015v-1.064c-.878-.328-1.912-.669-3-.968v1.017zm0-5.09v1.017c1.121.311 2.177.67 3 1.015v-1.064c-.878-.328-1.912-.669-3-.968zm0 3.058c1.121.31 2.177.67 3 1.015v-1.063c-.878-.328-1.912-.669-3-.968v1.016zm10 4.063c-1.121.31-2.177.67-3 1.015v-1.064c.878-.328 1.912-.669 3-.968v1.017zm0-3.048c-1.088.299-2.122.64-3 .968v1.064c.823-.345 1.879-.705 3-1.015v-1.017zm-3-3.105v1.064c.823-.345 1.879-.705 3-1.015v-1.017c-1.088.299-2.122.64-3 .968zm3 1.074c-1.088.299-2.122.64-3 .968v1.064c.823-.345 1.879-.705 3-1.015v-1.017z"/></svg>
        Ejemplares
    </a>
    <a href="{{ route('book.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.495 2h16.505v-2h-17c-1.656 0-3 1.343-3 3v18c0 1.657 1.344 3 3 3h17v-20h-16.505c-1.376 0-1.376-2 0-2zm7.561 7.273c.438-.372 1.084-.363 1.446.018.361.382.302.992-.135 1.364-.437.372-1.084.364-1.446-.018-.361-.382-.302-.992.135-1.364zm.583 4.567c-.627 1.508-1.075 2.525-1.331 3.31-.374 1.144.569.68 1.493-.173.127.206.167.271.294.508-2.054 1.953-4.331 2.125-3.623-.12.464-1.469 1.342-3.229 1.496-3.675.225-.646-.174-.934-1.429.171l-.278-.525c1.431-1.558 4.381-1.91 3.378.504z"/></svg>
        Libros
    </a>
    <a href="{{ route('author.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.473 7.196c-.425-.439-.401-1.127.035-1.552l4.461-4.326c.218-.211.498-.318.775-.318.282 0 .563.11.776.331l-6.047 5.865zm-7.334 11.021c-.092.089-.139.208-.139.327 0 .25.204.456.456.456.114 0 .229-.042.317-.128l.749-.729-.633-.654-.75.728zm6.33-8.425l-2.564 2.485c-1.378 1.336-2.081 2.63-2.73 4.437l1.132 1.169c1.825-.593 3.14-1.255 4.518-2.591l2.563-2.486-2.919-3.014zm7.477-7.659l-6.604 6.405 3.326 3.434 6.604-6.403c.485-.469.728-1.093.728-1.718 0-2.088-2.53-3.196-4.054-1.718zm-1.946 11.333v7.534h-16v-12h8.013l2.058-2h-12.071v16h20v-11.473l-2 1.939z"/></svg>
        Autores
    </a>
    <a href="{{ route('genre.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 13h-2v-4h2v4zm0-5h-2v-4h2v4zm0 6h-2v4h2v-4zm0 5h-2v4h2v-4zm-10.768-5.886c-.238.447-.392 1.025-.392 1.475 0 1.203 1.173 1.211 1.751.08.237-.465.391-1.058.391-1.51 0-.972-1.166-1.144-1.75-.045zm-5.737-9.114h13.505v20h-14c-1.656 0-3-1.343-3-3v-18c0-1.657 1.344-3 3-3h17v2h-16.505c-1.376 0-1.376 2 0 2zm2.505 10.159c0 2.098 1.409 3.724 4.014 3.724 1.44 0 2.356-.415 2.927-.736l-.392-.566c-.585.338-1.286.648-2.433.648-1.958 0-3.275-1.256-3.275-3.127 0-3.265 3.657-3.861 5.265-2.898 1.499.938 1.443 3.187.333 4.047-.592.472-1.257.456-1.042-.433 0 0 .693-2.564.774-2.842h-.778l-.156.543c-.158-.448-.539-.74-1.091-.74-1.153 0-2.128 1.251-2.128 2.733 0 .989.523 1.602 1.36 1.602.733 0 1.115-.415 1.351-.785-.172 1.659 3.271.893 3.271-2.012 0-1.854-1.503-3.2-3.575-3.2-2.837 0-4.425 1.8-4.425 4.042z"/></svg>
        Géneros
    </a>
    <a href="{{ route('category.index') }}" class="flex px-4 py-3 text-center hover:text-red-900 hover:bg-gray-200 transition ease-in-out duration-200 border-b border-gray-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
        Subgéneros
    </a>
</aside>