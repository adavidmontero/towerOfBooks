@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col p-6 break-words bg-white md:mb-10 mb-0 sm:border-1 sm:rounded-md sm:shadow-sm">

                <header class="font-semibold text-center text-sm bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8">
                    {{-- <span class="font-logo text-3xl block pb-2">{{ config('app.name', 'Laravel') }}</span> --}}
                    {{ __('Login') }} a TowerOfBooks
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required>

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-red-500 hover:text-red-700 whitespace-no-wrap ml-auto"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-red-500 hover:bg-red-700 sm:py-4">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __("Don't have an account?") }}
                            <a class="text-red-500 hover:text-red-700" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        @endif
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection
