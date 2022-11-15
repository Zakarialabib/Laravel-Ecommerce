@section('title', __('Verify your email'))
<x-app-layout>
    <div class="lg:w-1/2 py-10 px-5">

        <h3 class="text-xl font-bold text-center mb-4">
            {{ __('Verify your email') }}</h3>
            <p class="my-2 px-4 text-xl text-center text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        

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

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
