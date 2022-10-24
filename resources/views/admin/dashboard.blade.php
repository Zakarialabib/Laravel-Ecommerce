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

        <div class="flex flex-wrap -m-4 py-4">
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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

            <div class="w-full md:w-1/2 lg:w-1/5">
                <div class="p-6 rounded bg-white shadow-md">
                    <div class="flex mb-2">
                        <span class="inline-block mr-2">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </span>
                        <a href="{{ route('admin.blogs') }}">
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

            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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
            <div class="w-full md:w-1/2 lg:w-1/5">
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

        <div class="flex flex-row">

            <div class="lg:w-1/2 md:w-full6">
                <x-card>
                    <h5 class="card-header">{{ __('Recent Order(s)') }}</h5>
                    <div class="card-body">

                        <div class="table-responsive  dashboard-home-table">
                            <table id="poproducts" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Order Number') }}</th>
                                        <th>{{ __('Order Date') }}</th>
                                    </tr>
                                    @foreach ($rorders as $data)
                                        <tr>
                                            <td>{{ $data->order_number }}</td>
                                            <td>{{ date('Y-m-d', strtotime($data->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                        </div>

                    </div>
                </x-card>

            </div>

            <div class="lg:w-1/2 md:w-full6">
                <x-card>
                    <h5 class="card-header">{{ __('Recent Customer(s)') }}</h5>
                    <div class="card-body">

                        <div class="table-responsive  dashboard-home-table">
                            <table id="poproducts" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Customer Email') }}</th>
                                        <th>{{ __('Joined') }}</th>
                                    </tr>
                                    @foreach ($rusers as $data)
                                        <tr>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </thead>
                            </table>
                        </div>

                    </div>
                </x-card>
            </div>
        </div>

        <div class="flex flex-row">

            <div class="md:w-full">
                <x-card>
                    <h5 class="card-header">{{ __('Popular Product(s)') }}</h5>
                    <div class="card-body">

                        <div class="table-responsive  dashboard-home-table">
                            <table id="poproducts" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Featured Image') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($poproducts as $data)
                                        <tr>
                                            <td><img src="{{ asset('/upload/products/' . $data->feature_image) }}"
                                                    alt="{{ $data->name }}" width="50"></td>
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            </td>
                                            <td>{{ $data->category->name }}
                                                @if (isset($data->subcategory))
                                                    <br>
                                                    {{ $data->subcategory->name }}
                                                @endif
                                            </td>

                                            <td> {{ $data->price }} </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="flex flex-row">

            <div class="md:w-full">
                <x-card>
                    <h5 class="card-header">{{ __('Recent Product(s)') }}</h5>
                    <div class="card-body">

                        <div class="table-responsive dashboard-home-table">
                            <table id="pproducts" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Featured Image') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pproducts as $data)
                                        <tr>
                                            <td><img src="{{ asset('/upload/products/' . $data->feature_image) }}"
                                                    alt="{{ $data->name }}" width="50"></td>
                                            </td>
                                            <td>
                                                {{ $data->name }}
                                            </td>
                                            <td>{{ $data->category->name }}
                                                @if (isset($data->subcategory))
                                                    <br>
                                                    {{ $data->subcategory->name }}
                                                @endif
                                            </td>
                                            <td> {{ $data->price }} </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </x-card>

            </div>

        </div>

        <div class="flex flex-row">

            <div class="md:w-full">
                <x-card>
                    <h5 class="card-header">{{ __('Total Sales in Last 30 Days') }}</h5>
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

            $('#poproducts').dataTable({
                "ordering": false,
                'lengthChange': false,
                'searching': false,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                'responsive': true,
                'paging': false
            });

            $('#pproducts').dataTable({
                "ordering": false,
                'lengthChange': false,
                'searching': false,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                'responsive': true,
                'paging': false
            });

        })(jQuery);
    </script>
@endsection
