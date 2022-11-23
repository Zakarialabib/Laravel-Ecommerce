@section('title', __('Dashboard'))
<x-dashboard-layout>
    <div class="content-area">

        @if (Session::has('cache'))
            <div class="alert alert-success validation">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h3 class="text-center">{{ Session::get('cache') }}</h3>
            </div>
        @endif

        <div class="flex flex-wrap -m-4 py-4 justify-center">
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.orders') }}">
                                {{ __('Orders Pending!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($pending) }}</h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.orders') }}">
                                {{ __('Orders Procsessing!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($processing) }}</h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.orders') }}">
                                {{ __('Orders Completed!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($completed) }}</h2>
                </div>
            </div>
        </div>
        <div class="bg-white">
            <div class="md:inline-flex float-right pt-2 pb-5 sm:flex sm:flex-wrap">
                <x-button type="button" primary data-date="today"
                    class="js-date mr-2 active">
                    {{ __('Today') }}
                </x-button>
    
                <x-button type="button" primary data-date="month"
                    class="js-date mr-2">
                    {{ __('Last month') }}
                </x-button>
    
                <x-button type="button" primary data-date="semi"
                    class="js-date mr-2">
                    {{ __('Last 6 month') }}
                </x-button>
    
                <x-button type="button" primary data-date="year"
                    class="js-date">
                    {{ __('Last year') }}
                </x-button>
            </div>
            @foreach ($data as $key => $d)
                @if ($loop->first)
                    <div class="w-full flex flex-wrap align-center mb-4 js-date-row" id="{{ $key }}">
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 w-full">
                            <div
                                class="flex items-center p-4 bg-white dark:bg-dark-bg dark:text-gray-300 rounded-lg shadow-md">
                                <div class="p-5 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-300">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700 dark:text-gray-300">
                                        {{ $d['countCustomers'] }}
                                    </p>
                                </div>
                            </div>
    
                            <div
                                class="flex items-center p-4 bg-white dark:bg-dark-bg dark:text-gray-300 rounded-lg shadow-md">
                                <div class="p-5 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-300">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700 dark:text-gray-300">
                                        {{ $d['ordersCount'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full flex flex-wrap align-center mb-4 js-date-row" style="display: none"
                        id="{{ $key }}">
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 w-full">
                            <div
                                class="flex items-center p-4 bg-white dark:bg-dark-bg dark:text-gray-300 rounded-lg shadow-md">
                                <div class="p-5 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-300">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700 dark:text-gray-300">
                                        {{ $d['countCustomers'] }}
                                    </p>
                                </div>
                            </div>
    
                            <div
                                class="flex items-center p-4 bg-white dark:bg-dark-bg dark:text-gray-300 rounded-lg shadow-md">
                                <div class="p-5 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600 dark:text-gray-300">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700 dark:text-gray-300">
                                        {{ $d['ordersCount'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>

        <div class="flex flex-row my-4">

            <div class="lg:w-1/2 md:w-full6">
                <x-card>
                    <h5 class="font-bold py-2 text-xl">{{ __('Recent Order(s)') }}</h5>
                    <div class="card-body">

                        <div class="">
                            <x-table>
                                <x-slot name="thead">
                                    <x-table.tr>
                                        <x-table.th>{{ __('Order Number') }}</x-table.th>
                                        <x-table.th>{{ __('Order Date') }}</x-table.th>
                                    </x-table.tr>
                                    @foreach ($rorders as $data)
                                        <x-table.tr>
                                            <x-table.td>{{ $data->order_number }}</x-table.td>
                                            <x-table.td>{{ date('Y-m-d', strtotime($data->created_at)) }}</x-table.td>
                                        </x-table.tr>
                                    @endforeach
                                </x-slot>
                            </x-table>
                        </div>

                    </div>
                </x-card>

            </div>

            <div class="lg:w-1/2 md:w-full6">
                <x-card>
                    <h5 class="font-bold py-2 text-xl">{{ __('Recent Customer(s)') }}</h5>
                    <div class="card-body">

                        <div class="table-responsive  dashboard-home-table">
                            <x-table>
                                <x-slot name="thead">
                                    <x-table.tr>
                                        <x-table.th>{{ __('Customer Email') }}</x-table.th>
                                        <x-table.th>{{ __('Joined') }}</x-table.th>
                                    </x-table.tr>
                                    @foreach ($rusers as $data)
                                        <x-table.tr>
                                            <x-table.td>{{ $data->email }}</x-table.td>
                                            <x-table.td>{{ $data->created_at }}</x-table.td>
                                        </x-table.tr>
                                    @endforeach
                                </x-slot>
                                </x-table.table>
                        </div>

                    </div>
                </x-card>
            </div>
        </div>

        <div class="flex flex-row my-4">

            <div class="md:w-full">
                <x-card>
                    <h5 class="font-bold py-2 text-xl">{{ __('Popular Product(s)') }}</h5>
                    <div class="card-body">

                        <div class="">
                            <x-table>
                                <x-slot name="thead">
                                    <x-table.th>{{ __('Featured Image') }}</x-table.th>
                                    <x-table.th>{{ __('Name') }}</x-table.th>
                                    <x-table.th>{{ __('Category') }}</x-table.th>
                                    <x-table.th>{{ __('Price') }}</x-table.th>
                                </x-slot>
                                <x-table.tbody>
                                    @foreach ($poproducts as $data)
                                        <x-table.tr>
                                            <x-table.td><img src="{{ asset('images/products/' . $data->image) }}"
                                                    alt="{{ $data->name }}" width="50"></x-table.td>
                                            <x-table.td>{{ $data->name }}</x-table.td>
                                            <x-table.td>
                                                {{ $data->category->name }}
                                                @if (isset($data->subcategory))
                                                    <br>
                                                    {{ $data->subcategory->name }}
                                                @endif
                                            </x-table.td>

                                            <x-table.td> {{ $data->price }} </x-table.td>

                                        </x-table.tr>
                                    @endforeach
                                </x-table.tbody>
                            </x-table>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="flex flex-row my-4">

            <div class="md:w-full">
                <x-card>
                    <h5 class="font-bold py-2 text-xl">{{ __('Recent Product(s)') }}</h5>
                    <div class="card-body">

                        <div class="">
                            <x-table>
                                <x-slot name="thead">
                                    <x-table.th>{{ __('Featured Image') }}</x-table.th>
                                    <x-table.th>{{ __('Name') }}</x-table.th>
                                    <x-table.th>{{ __('Category') }}</x-table.th>
                                    <x-table.th>{{ __('Price') }}</x-table.th>
                                </x-slot>
                                <x-table.tbody>
                                    @foreach ($pproducts as $data)
                                        <x-table.tr>
                                            <x-table.td>
                                                <img src="{{ asset('images/products/' . $data->image) }}"
                                                    alt="{{ $data->name }}" width="50">
                                            </x-table.td>
                                            <x-table.td>
                                                {{ $data->name }}
                                            </x-table.td>
                                            <x-table.td>
                                                {{ $data->category->name }}
                                                @if (isset($data->subcategory))
                                                    <br>
                                                    {{ $data->subcategory->name }}
                                                @endif
                                            </x-table.td>
                                            <x-table.td> {{ $data->price }} </x-table.td>

                                        </x-table.tr>
                                    @endforeach
                                </x-table.tbody>
                            </x-table>
                        </div>

                    </div>
                </x-card>

            </div>

        </div>

        <div class="flex flex-row">

            <div class="md:w-full">
                <x-card>
                    <h5 class="font-bold py-2 text-xl">{{ __('Total Sales in Last 30 Days') }}</h5>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-dashboard-layout>

@section('scripts')
    <script type="text/javascript">
        (function($) {
            "use strict";

            displayLineChart();

            function displayLineChart() {
                var data = {
                    labels: [
                        {!! $days !!}
                    ],
                    datasets: [{
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            {!! $sales !!}
                        ]
                    }]
                };
                var ctx = document.getElementById("lineChart").getContext("2d");
                var options = {
                    responsive: true
                };
                var lineChart = new Chart(ctx).Line(data, options);
            }
            
        })(jQuery);
    </script>
    <script>
        document.querySelectorAll('.js-date').forEach(el => {
            el.addEventListener('click', event => {
                clearActive();
                hideAll();
                el.classList.add('active');
                document.querySelector(`#${el.dataset.date}`).style.display = 'flex';
            });
        });

        const clearActive = () => {
            document.querySelectorAll('.js-date').forEach(el => {
                el.classList.remove('active');
            });
        };

        const hideAll = () => {
            document.querySelectorAll('.js-date-row').forEach(el => {
                el.style.display = 'none';
            });
        };
    </script>
@endsection
