@section('title', __('Orders'))

<x-dashboard-layout>
    <input type="hidden" id="headerdata" value="{{ __('ORDER') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('All Orders') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders') }}">{{ __('All Orders') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @livewire('admin.order.index')
    </div>
</x-dashboard-layout>