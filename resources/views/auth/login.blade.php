<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Application Logo" class="h-10 w-auto">
        </x-slot>

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-black">{{ __('LOGIN') }}</h2>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
                    {{ __('Sign up here') }}
                </a>
            </p>
        </div>
        <!-- Add the Admin Link Here -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                {{ __('Are you an admin?') }}
                <a href="{{ route('admin.login') }}" class="text-indigo-600 hover:underline">
                    {{ __('Login here') }}
                </a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
