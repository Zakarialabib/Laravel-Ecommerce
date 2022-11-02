@section('title', __('Categories'))
<x-dashboard-layout>
    <input type="hidden" id="headerdata" value="{{ __('POST') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="heading">{{ __('Posts') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Blog') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.blogs') }}">{{ __('Posts') }}</a>
                        </li>
                    </ul>
                </div>
               
            </div>
        </div>
        @livewire('admin.blog.index')
    </div>

  </x-dashboard-layout>