@extends('backoffice.layouts.app')

@section('content')
    <section class="flex flex-col p-6 break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm md:shadow-lg mt-6">
        <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8">
            Dashboard
        </header>

        <div class="w-full p-6 leading-6">
            <p class="text-gray-700">
                You are logged in!
            </p>
            <p class="text-gray-700">
                Estás en la vista para administradores y secretarios
            </p>
        </div>
    </section>
@endsection
