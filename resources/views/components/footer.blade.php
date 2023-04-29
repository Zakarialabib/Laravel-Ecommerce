<section class="pt-10 pb-5 px-10 bg-gray-900 mx-auto">
    <div class="flex flex-wrap -mx-4 pb-2 lg:pb-4 border-b border-gray-400">
        <div class="w-full lg:w-3/5 px-4 mb-10">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-10 lg:mb-0">
                    <h3 class="mb-8 text-xl font-bold font-heading text-white border-b border-beige-400">
                        {{ __('Information') }}</h3>
                    <ul>
                        <li class="mb-6"><a class="text-white hover:text-beige-400 hover:underline" href="#">
                                {{ __('Blog') }}
                            </a>
                        </li>
                        <li>
                            <a class="text-white hover:text-beige-400 hover:underline"
                                href="#">{{ __('Repair Service') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-10 lg:mb-0">
                    <h3 class="mb-8 text-xl font-bold font-heading text-white border-b border-beige-400">
                        {{ __('Customer Service') }}</h3>
                    <ul>
                        <li class="mb-6">
                            <a class="text-white hover:text-beige-400 hover:underline" href="#">
                                {{ __('Orders and Returns') }}</a>
                        </li>
                        <li>
                            <a class="text-white hover:text-beige-400 hover:underline"
                                href="{{ route('front.contact') }}">
                                {{ __('Store Location & Contact') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
                    <h3 class="mb-8 text-xl text-white font-bold font-heading border-b border-beige-400">
                        {{ __('Contact Us') }}</h3>
                    <ul>
                        <li class="mb-6">
                            <h4 class="mb-2 text-gray-50">{{ __('Telephone') }}</h4>
                            <a class="text-white hover:text-beige-400 hover:underline"
                                href="tel:{{ Helpers::settings('company_phone') }}">
                                {{ Helpers::settings('company_phone') }}
                            </a>
                        </li>
                        <li class="mb-6">
                            <h4 class="mb-2 text-gray-50">{{ __('Email') }}</h4>
                            <a class="text-white hover:text-beige-400 hover:underline"
                                href="mailto:{{ Helpers::settings('company_email_address') }}">
                                {{ Helpers::settings('company_email_address') }}
                            </a>
                        </li>
                        <li>
                            <h4 class="mb-2 text-gray-50">{{ __('Whatsapp') }}</h4>
                            <a class="text-white hover:text-beige-400 hover:underline" href="#" target="_blank">
                                {{ Helpers::settings('social_whatsapp') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/5 px-4 order-first lg:order-1 mb-100">
            <livewire:front.newsletters-form />
            <div class="w-full flex flex-wrap lg:justify-between sm:justify-center mb-4">
                <div class="w-full md:w-auto flex justify-center items-center gap-4">
                    <a class="inline-flex w-12 h-12"
                        href="{{ Helpers::settings('social_facebook') }}" target="_blank">
                        <i class="fab fa-facebook-f text-xl text-white hover:text-beige-200 transition"></i>
                    </a>
                    <a class="inline-flex w-12 h-12"
                        href="{{ Helpers::settings('social_instagram') }}" target="_blank">
                        <i class="fab fa-instagram text-xl text-white hover:text-beige-200 transition"></i>
                    </a>
                    <a class="inline-flex w-12 h-12"
                        href="{{ Helpers::settings('social_twitter') }}" target="_blank">
                        <i class="fab fa-twitter text-xl text-white hover:text-beige-200 transition"></i>
                    </a>
                    <a class="inline-flex w-12 h-12"
                        href="{{ Helpers::settings('social_linkedin') }}" target="_blank">
                        <i class="fab fa-linkedin-in text-xl text-white hover:text-beige-200 transition"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="pt-5 flex items-center justify-center">
        <p class="inline-block text-sm text-gray-200">
            <a class="uppercase hover:text-beige-500" href="https://behance.net/zakarialabib" target="_blank">handcrafted
                by zakaria labib</a>
        </p>
    </div>
</section>
