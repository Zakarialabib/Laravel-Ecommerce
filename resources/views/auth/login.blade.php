@section('title', __('Login to your account'))
<x-app-layout>
    <div class="flex flex-wrap h-screen">
        <div class="w-full lg:w-1/2 py-10 px-5">

            <h3 class="text-xl font-bold text-center mb-4">{{ __('Login to your account') }}</h3>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-zinc-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-zinc-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-zinc-600 hover:text-zinc-900"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3" primary type="submit">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>

        </div>

        <div class="lg:w-1/2 sm:w-full relative pb-full md:flex md:pb-0">
            <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);"
                class="absolute pin bg-no-repeat md:bg-left w-full h-full bg-center bg-cover"></div>
        </div>
    </div>
</x-app-layout>
