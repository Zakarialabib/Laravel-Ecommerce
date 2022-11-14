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
        <div class="flex flex-wrap -m-4 py-4 justify-center">
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.users') }}">
                                {{ __('Total Customers!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($users) }}</h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.users') }}">
                                {{ __('Total Customers!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($users) }}</h2>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <h3 class="text-sm text-gray-600">
                            <a href="{{ route('admin.blogs') }}">
                                {{ __('Total Posts!') }}
                            </a>
                        </h3>
                    </div>
                    <h2 class="mb-2 text-3xl font-bold">{{ count($blogs) }}</h2>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4 py-4 justify-center">
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <a href="{{ route('admin.users') }}">
                            <h3 class="text-sm text-gray-600">
                                {{ __('New Customers!') }}
                            </h3>
                            <p>
                                {{ __('Last 30 Days') }}
                            </p>
                        </a>

                    </div>
                    <h2 class="mb-2 text-3xl font-bold">
                        {{ App\Models\User::where('created_at', '>', Carbon\Carbon::now()->subDays(30))->get()->count() }}
                    </h2>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <a href="{{ route('admin.blogs') }}">
                            <h3 class="text-sm text-gray-600">
                                {{ __('Customers Customers!') }}
                            </h3>
                            <p>
                                {{ __('All Time') }}
                            </p>
                        </a>

                    </div>
                    <h2 class="mb-2 text-3xl font-bold">
                        {{ App\Models\User::count() }}
                    </h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <a href="{{ route('admin.blogs') }}">
                            <h3 class="text-sm text-gray-600">
                                {{ __('Total Sales!') }}
                            </h3>
                            <p>
                                {{ __('Last 30 days') }}
                            </p>
                        </a>

                    </div>
                    <h2 class="mb-2 text-3xl font-bold">
                        {{ App\Models\Order::where('status', '=', 'completed')->where('created_at', '>', Carbon\Carbon::now()->subDays(30))->get()->count() }}
                    </h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/4 px-2">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <a href="{{ route('admin.blogs') }}">
                            <h3 class="text-sm text-gray-600">
                                {{ __('Total Sales!') }}
                            </h3>
                            <p>
                                {{ __('All Times') }}
                            </p>
                        </a>

                    </div>
                    <h2 class="mb-2 text-3xl font-bold">
                        {{ App\Models\Order::where('status', '=', 'completed')->get()->count() }}
                    </h2>
                </div>
            </div>
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
@endsection
