<x-app-layout>
    @section('title', __('Verify your email'))
    <div class="search-nav">
        <div class="container">
            <h3 class="text-center">{{ __('Verify your email') }}</h3>
            <p class="my-2 px-4 text-xl text-center text-zinc-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>
    </div>
    <x-auth-card>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-zinc-600 hover:text-zinc-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-app-layout>
