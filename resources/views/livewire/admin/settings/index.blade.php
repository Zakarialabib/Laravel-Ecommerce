<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="save" enctype="multipart/form-data">

        <div>
            <div class="w-full flex flex-wrap">
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="company_name" :value="__('Company name')" />
                    <x-input type="text" wire:model="company_name" id="company_name" />
                    <x-input-error for="company_name" :messages="$errors->first('company_name')" />
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="site_title" :value="__('Website title')" />
                    <x-input type="text" wire:model="site_title" id="site_title" />
                    <x-input-error for="site_title" :messages="$errors->first('site_title')" />
                </div>

                <div class="lg:w-1/2 sm:w-full mt-2 px-2">
                    <x-label for="company_email_address" :value="__('Company email')" />
                    <x-input wire:model="company_email_address" type="email" id="company_email_address"
                        name="company_email_address" />
                    <x-input-error for="company_email_address" :messages="$errors->first('company_email_address')" />
                </div>
                <div class="lg:w-1/2 sm:w-full mt-2 px-2">
                    <x-label for="company_phone" :value="__('Company phone')" />
                    <x-input wire:model="company_phone" type="text" id="company_phone" name="company_phone" />
                    <x-input-error for="company_phone" :messages="$errors->first('company_phone')" />
                </div>
                <div class="w-full mt-2 px-2">
                    <x-label for="company_address" :value="__('Company address')" />
                    <x-input wire:model="company_address" type="text" id="company_address" name="company_address" />
                    <x-input-error for="company_address" :messages="$errors->first('company_address')" />
                </div>
            </div>

            <div class="mt-5 flex flex-wrap">
                <div class="lg:w-1/2 sm:w-full px-2">
                    <div class="flex flex-col">
                        <div class="w-1/2">
                            @if ($siteImage != null)
                                <img src="{{ asset('images/' . $siteImage) }}" id="logoImg"
                                    style="width: 200px; height: 150px;">
                            @else
                                <img src="https://via.placeholder.com/250x150?text=Placeholder+Image" id="logoImg"
                                    style="width: 200px; height: 150px;">
                            @endif
                        </div>
                        <div class="w-3/4">
                            <div class="mb-4">
                                <x-label for="logoFile" :value="__('Import Logo')" />
                                <x-input type="file" wire:model="logoFile" onchange="loadFile(event,'logoImg')" />
                                <x-input-error for="logoFile" :messages="$errors->first('logoFile')" />

                                <div class="mt-5">
                                    <x-button type="submit" wire:click.prevent='uploadLogo()' primary>
                                        <i class="fas fa-upload"></i>
                                        {{ __('Import') }}
                                    </x-button>
                                </div>
                                <small
                                    class="text-red-500">{{ __('Extensions accepted (jpeg,png,jpg,gif,svg), Max size 1048kb.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 sm:w-full px-2">
                    <div class="flex flex-col">
                        <div class="w-1/2">
                            @if ($favicon != null)
                                <img src="{{ asset('images/' . $favicon) }}" id="logoImg"
                                    style="width: 200px; height: 150px;">
                            @else
                                <img src="https://via.placeholder.com/250x150?text=Placeholder+Image" id="logoImg"
                                    style="width: 200px; height: 150px;">
                            @endif
                        </div>
                        <div class="w-3/4">
                            <div class="mb-4">
                                <x-label for="iconFile" :value="__('Import favicon')" />
                                <x-input type="file" wire:model="iconFile" />
                                <x-input-error for="iconFile" :messages="$errors->first('iconFile')" />

                                <div class="mt-5">
                                    <x-button type="submit" wire:click.prevent='uploadFavicon()' primary>
                                        <i class="fas fa-upload"></i>
                                        {{ __('Import') }}
                                    </x-button>
                                </div>
                                <small
                                    class="text-red-500">{{ __('Extensions accepted (jpeg,png,jpg,gif,svg), Max size 1048kb.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-wrap">
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="social_facebook" :value="__('Facebook Link')" />
                    <x-input wire:model="social_facebook" type="text" id="social_facebook" name="social_facebook" />
                    <x-input-error for="social_facebook" :messages="$errors->first('social_facebook')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="social_twitter" :value="__('Twitter Link')" />
                    <x-input wire:model="social_twitter" type="text" id="social_twitter" name="social_twitter" />
                    <x-input-error for="social_twitter" :messages="$errors->first('social_twitter')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="social_instagram" :value="__('Instagram Link')" />
                    <x-input wire:model="social_instagram" type="text" id="social_instagram"
                        name="social_instagram" />
                    <x-input-error for="social_instagram" :messages="$errors->first('social_instagram')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="social_linkedin" :value="__('Linkedin Link')" />
                    <x-input wire:model="social_linkedin" type="text" id="social_linkedin"
                        name="social_linkedin" />
                    <x-input-error for="social_linkedin" :messages="$errors->first('social_linkedin')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="social_whatsapp" :value="__('Whatsapp number')" />
                    <x-input wire:model="social_whatsapp" type="text" id="social_whatsapp"
                        name="social_whatsapp" />
                    <x-input-error for="social_whatsapp" :messages="$errors->first('social_whatsapp')" />
                    <small
                        class="text-red-500">{{ __("Use this number format 1XXXXXXXXXX Don't use this +001-(XXX)XXXXXXX") }}</small>
                </div>
            </div>
            <div class="w-full">
                <div class="mb-4 px-2">
                    <x-label for="head_tags" :value="__('Custom Head Code')" />
                    <textarea class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        rows="4" id="head_tags" name="head_tags" wire:model="head_tags">{!! Config::get('settings.head_tags') !!}</textarea>
                    <small class="text-red-500">{{ __('Facebook, Google Analytics or other script.') }}</small>
                </div>
                <div class="mb-4 px-2">
                    <x-label for="body_tags" :value="__('Custom Body Code')" />
                    <textarea
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                        rows="4" id="body_tags" name="body_tags" wire:model="body_tags">{{ Config::get('settings.body_tags') }}</textarea>
                    <small class="text-red-500">{{ __('Facebook, Google Analytics or other script.') }}</small>
                </div>
            </div>
            <div class="w-full flex flex-row">
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="enableRegistrationTerms" :value="__('Enable Registration Terms')" />
                    <x-checkbox name="enableRegistrationTerms" id="enableRegistrationTerms"
                        wire:model="enableRegistrationTerms" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_return" :value="__('Enable Return page')" />
                    <x-checkbox name="site_return" id="site_return" wire:model="site_return" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_refund" :value="__('Enable Refund  page')" />
                    <x-checkbox name="site_refund" id="site_refund" wire:model="site_refund" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_terms" :value="__('Enable Terms  page')" />
                    <x-checkbox name="site_terms" id="site_terms" wire:model="site_terms" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_privacy" :value="__('Enable Privacy page')" />
                    <x-checkbox name="site_privacy" id="site_privacy" wire:model="site_privacy" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_about" :value="__('Enable About page')" />
                    <x-checkbox name="site_about" id="site_about" wire:model="site_about" />
                </div>
                <div class="sm:w-1/2 mb-4 px-2">
                    <x-label for="site_contact" :value="__('Enable Contact page')" />
                    <x-checkbox name="site_contact" id="site_contact" wire:model="site_contact" />
                </div>
            </div>
            <div class="flex flex-wrap mb-4">
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="currency_code" :value="__('Currency code')" />
                    <x-input wire:model="currency_code" type="text" id="currency_code" name="currency_code" />
                    <x-input-error for="currency_code" :messages="$errors->first('currency_code')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="currency_symbol" :value="__('Currency symbol')" />
                    <x-input wire:model="currency_symbol" type="text" id="currency_symbol"
                        name="currency_symbol" />
                    <x-input-error for="currency_symbol" :messages="$errors->first('currency_symbol')" />
                </div>
                <div class="lg:w-1/2 sm:w-full px-2">
                    <x-label for="currency_position" :value="__('Currency Position')" />
                    <select wire:model="currency_position" name="currency_position" id="currency_position"
                        class="p-3 leading-5 bg-white text-gray-700 rounded border border-zinc-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500">
                        <option selected option>
                        <option value="left">{{ __('Left') }}</option>
                        <option value="right">{{ __('Right') }}</option>
                    </select>
                    <x-input-error for="currency_position" :messages="$errors->first('currency_position')" />
                </div>
            </div>
            <div class="w-full">
                <div class="mb-4 px-2">
                    <x-label for="seo_meta_title" :value="__('Seo Meta Title')" />
                    <x-input wire:model="seo_meta_title" type="text" id="seo_meta_title" name="seo_meta_title" />
                    <x-input-error for="seo_meta_title" :messages="$errors->first('seo_meta_title')" />
                </div>
                <div class="mb-4 px-2">
                    <x-label for="seo_meta_description" :value="__('Seo Meta Description')" />
                    <x-input wire:model="seo_meta_description" type="text" id="seo_meta_description"
                        name="seo_meta_description" />
                    <x-input-error for="seo_meta_description" :messages="$errors->first('seo_meta_description')" />
                </div>
            </div>
            <div class="w-full">
                <div class="mb-4 px-2">
                    <x-label for="footer_copyright_text" :value="__('Footer Copyright Text')" />
                    <x-input wire:model="footer_copyright_text" type="text" id="footer_copyright_text"
                        name="footer_copyright_text" />
                    <x-input-error for="footer_copyright_text" :messages="$errors->first('footer_copyright_text')" />
                </div>
            </div>
            <div class="w-full p-2 mb-4">
                <x-button type="submit" primary class="block" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button>
            </div>
        </div>
    </form>
</div>


{{-- <x-laravelpopups-popupsettings /> --}}