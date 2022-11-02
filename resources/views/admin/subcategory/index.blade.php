@section('title', __('SubCategories'))
<x-dashboard-layout>
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Sub Categories') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li><a href="javascript:;">{{ __('Manage Categories') }}</a></li>
                        <li>
                            <a href="{{ route('admin.subcategories') }}">{{ __('Sub Categories') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 table-contents">
                    <!-- Button trigger livewire modal -->
                    <x-button primary type="button" onclick="Livewire.emit('createSubcategory', 'show')">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </div>
        </div>
        @livewire('admin.subcategory.index')
    </div>
</x-dashboard-layout>
