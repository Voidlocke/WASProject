<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Application Logo" class="h-10 w-auto">
        </x-slot>

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-black">{{ __('ADMIN LOGIN') }}</h2>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                {{ __('Not an admin?') }}
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">
                    {{ __('User login here') }}
                </a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
