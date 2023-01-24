<div>
    <form wire:submit.prevent="update">

        <x-form-alert />

        <div class="flex justify-center">

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="category">{{ __('Featured Products') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="category" value="1"
                        {{ $data->category == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="slider">{{ __('Slider') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="slider" value="1"
                        {{ $data->slider == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

        </div>

        <div class="row justify-content-center">

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label
                    for="top_big_trending">{{ __('Top Rated, Big Save & Trending') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="top_big_trending" value="1"
                        {{ $data->top_big_trending == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="partner">{{ __('Partner') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="partner" value="1"
                        {{ $data->partner == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="best_sellers">{{ __('Best Selling Product') }}
                    *</label>
                <label class="switch">
                    <input type="checkbox" name="best_sellers" value="1"
                        {{ $data->best_sellers == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            
            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="blog">{{ __('Blogs') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="blog" value="1"
                        {{ $data->blog == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>

        <div class="flex justifiy-center">

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="home">{{ __('Home') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="home" value="1" {{ $data->home == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="blog">{{ __('Blog') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="blog" value="1" {{ $data->blog == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

        </div>

        <div class="flex justifiy-center">

            <div class="lg:w-1/2 sm:w-full px-2 justify-between">
                <label for="contact_us">{{ __('Contact Us') }} *</label>
                <label class="switch">
                    <input type="checkbox" name="contact" value="1" {{ $data->contact == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>


        <div class="flex">
            <div class="w-full px-4 text-center">
                <x-button type="submit" primary wire:loading.attr="disabled" wire:target="update">
                    {{ __('Update') }}
                </x-button>
            </div>
        </div>

    </form>
</div>
