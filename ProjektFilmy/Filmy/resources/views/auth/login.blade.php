<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Hasło')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Zaloguj się') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center border-t pt-4">
            <p class="text-sm text-gray-600 mb-2">Nie masz jeszcze konta?</p>
            <a href="{{ route('register') }}"
               class="w-full inline-block text-center bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded transition">
                Utwórz konto
            </a>
        </div>
    </form>
</x-guest-layout>