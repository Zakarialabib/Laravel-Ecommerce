@section('title', __('Dashboard'))
<x-dashboard-layout>
    <div>
        <div class="bg-white">
            <div class="md:inline-flex float-right pt-2 pb-5 sm:flex sm:flex-wrap">
                <x-button type="button" primary data-date="today" class="js-date mr-2 active">
                    {{ __('Today') }}
                </x-button>

                <x-button type="button" primary data-date="month" class="js-date mr-2">
                    {{ __('Last month') }}
                </x-button>

                <x-button type="button" primary data-date="semi" class="js-date mr-2">
                    {{ __('Last 6 month') }}
                </x-button>

                <x-button type="button" primary data-date="year" class="js-date">
                    {{ __('Last year') }}
                </x-button>
            </div>
            @foreach ($customData as $key => $d)
                @if ($loop->first)
                    <div class="w-full flex flex-wrap align-center mb-4 js-date-row" id="{{ $key }}">
                        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 w-full">
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['countCustomers'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                            class="flex items-center p-4 bg-white rounded-lg shadow-md">
                            <div>
                                <p class="mb-2 text-lg font-medium text-gray-600">
                                    {{ __('Orders') }}
                                </p>
                                <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                    {{ $d['ordersCount'] }}
                                </p>
                            </div>
                        </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Pending') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['orderPending'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Processing') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['orderProcessing'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Completed') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['orderCompleted'] }}
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
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Customers') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['countCustomers'] }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['ordersCount'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Processing') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['orderProcessing'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders Completed') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
                                        {{ $d['orderCompleted'] }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-white rounded-lg shadow-md">
                                <div>
                                    <p class="mb-2 text-lg font-medium text-gray-600">
                                        {{ __('Orders') }}
                                    </p>
                                    <p class="text-3xl sm:text-lg font-bold text-gray-700">
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
                                    @foreach ($recentOrders as $data)
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
                                </x-slot>
                                <x-table.tbody>
                                    @foreach ($recentUsers as $data)
                                        <x-table.tr>
                                            <x-table.td>{{ $data->email }}</x-table.td>
                                            <x-table.td>{{ $data->created_at }}</x-table.td>
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
        
        <x-core-web-vital-insight-component/>

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
