@section('title', __('Recover your password'))

<x-app-layout>
    <div class="flex flex-wrap">
        <div class="lg:w-1/2 py-10 px-5">

            <h3 class="text-xl font-bold text-center mb-4">
                {{ __('Recover your password') }}
            </h3>
            <p class="my-2 px-4 text-xl text-center text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" primary type="submit">
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
            </x-auth-card>
        </div>

        <div class="lg:w-1/2 sm:w-full relative pb-full md:flex md:pb-0">
            <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);"
                class="absolute pin bg-no-repeat md:bg-left w-full h-full bg-center bg-cover"></div>
        </div>
    </div>
</x-app-layout>
