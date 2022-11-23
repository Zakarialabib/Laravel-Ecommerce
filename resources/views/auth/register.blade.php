    @section('title', __('Sign up & create your account'))
    <x-app-layout>
        <div class="flex flex-wrap h-screen">
            <div class="w-full lg:w-1/2 py-10 px-5 my-auto">

                <h1 class="text-3xl md:text-xl font-bold text-center mb-4">
                    {{ __('Sign up now') }}
                </h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="flex flex-wrap mx-2">
                        <!-- First Name -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="first_name" :value="__('File name')" required />

                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus />
                        </div>
                        <!-- Last Name -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="last_name" :value="__('Last name')" required />

                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name')" required autofocus />
                        </div>
                    
                        <!-- Email Address -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="email" :value="__('Email')" required />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>

                        <!-- Phone -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="phone" :value="__('Phone')" required />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone"
                                :value="old('phone')" required />
                        </div>
                    
                        <!-- City -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="city" :value="__('City')" required />

                            <x-input id="city" class="block mt-1 w-full" type="email" name="city"
                                :value="old('city')" required />
                        </div>

                        <!-- Address -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="address" :value="__('Address')" required />
                            <x-input id="address" class="block mt-1 w-full" type="number" name="address"
                                :value="old('address')" required />
                        </div>
                    
                        <!-- Password -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="password" :value="__('Password')" required />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="lg:w-1/2 sm:w-full px-2">
                            <x-label for="password_confirmation" :value="__('Confirm password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-3" primary type="submit">
                            {{ __('Register') }}
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
