<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" dir="rtl">
            @csrf

            <div>
                <x-label for="email" value="{{ __('site.email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('site.password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('site.remember_me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('site.forgot_password') }}
                    </a>
                @endif

                <x-button class="mr-4">
                    {{ __('site.login') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
