<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Stats;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Transactions extends Component
{
    public $typeChart = 'monthly';

    public $categoriesCount;
    public $topProduct;
    public $productCount;
    public $ordersCount;
    public $userCount;
    public $bestOrders;
    public $charts;
    public $orders;
    public $orders_count;

    public function mount()
    {
        $this->categoriesCount = Category::count('id');
        $this->productCount = Product::count('id');
        $this->userCount = User::count('id');
    
        $this->bestOrders = Order::query()
            ->select('orders.*', 'users.first_name')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->whereMonth('orders.created_at', now()->month())
            ->orderBy('orders.total', 'desc')
            ->take(5)
            ->get();

        $this->topProduct = OrderProduct::query()
            ->selectRaw('SUM(order_products.qty) as qtyItem, products.name as name, products.code as code')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->whereMonth('order_products.created_at', now()->month())
            ->groupBy('order_products.product_id', 'products.name', 'products.code')
            ->orderByDesc('qtyItem')
            ->limit(5)
            ->get();

        $this->orders_count = Order::whereDate('created_at', '>=', now()->subWeek())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as orders'))
            ->groupBy('date')
            ->pluck('orders');

        $this->chart();
    }

    public function chart()
    {
        $query = Order::selectRaw('SUM(total) as total')
            ->when($this->typeChart === 'monthly', function ($q) {
                return $q->selectRaw('MONTH(created_at) as labels, COUNT(*) as orders')
                    ->whereYear('created_at', '=', date('Y'))
                    ->groupByRaw('MONTH(created_at)');
            }, function ($q) {
                return $q->selectRaw('YEAR(created_at) as labels, COUNT(*) as orders')
                    ->groupByRaw('YEAR(created_at)');
            })
            ->get()
            ->toArray();

        $orders = [
            'total'      => array_column($query, 'total'),
            'due_amount' => array_map(function ($total, $dueAmount) {
                return $total - $dueAmount;
            }, array_column($query, 'total'), array_column($query, 'due_amount')),
            'labels' => array_column($query, 'labels'),
        ];

        $this->charts = json_encode([
            'total' => [
                'orders'    => $orders['total'],
            ],
            'due_amount' => [
                'orders'    => $orders['due_amount'],
            ],
            'labels' => $orders['labels'],
        ]);
    }

    protected function getChart($orders)
    {
        $dataarray = [];
        $i = 0;

        foreach ($orders as $order) {
            $dataarray['total']['orders'][$i] = $order['total'];
            $dataarray['total']['orders'][$i] = $order['total'] - $order['total'];
            $dataarray['labels'][$i] = $order['labels'];
            $i++;
        }

        return json_encode($dataarray);
    }

    public function getDailyChartOptionsProperty()
    {
        $currentMonth = Carbon::now()->startOfMonth();

        // Get all days in the current month
        $daysInMonth = [];
        $currentDay = Carbon::now()->startOfMonth();

        while ($currentDay->month == $currentMonth->month) {
            $daysInMonth[] = $currentDay->format('Y-m-d');
            $currentDay->addDay();
        }

        // Get orders data for each day in the current month
        $ordersData = Order::selectRaw('DATE(created_at) as day, SUM(total) as total_orders')
            ->whereBetween('created_at', [$currentMonth, Carbon::now()->endOfMonth()])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->get();

        // Combine orders
        $chartData = [];

        foreach ($daysInMonth as $day) {
            $order = $ordersData->where('day', $day)->first();
            $chartData[] = [
                'day'       => $day,
                'orders'     => ($order) ? $order->total_orders : 0,
            ];
        }

        // Create stacked bar chart options
        $dailyChartOptions = [
            'chart' => [
                'type'    => 'bar',
                'stacked' => true,
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal'  => false,
                    'endingShape' => 'flat',
                    'columnWidth' => '70%',
                ],
            ],
            'series' => [
                [
                    'name' => __('Orders'),
                    'data' => array_column($chartData, 'orders'),
                ],
            ],
            'xaxis' => [
                'categories' => array_column($chartData, 'day'),
                'labels'     => [
                    'rotateAlways' => true,
                    'rotate'       => -45,
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => __('Amount'),
                ],
            ],
            'legend' => [
                'position'        => 'top',
                'horizontalAlign' => 'center',
                'offsetX'         => 40,
            ],
            'colors' => ['#4CAF50', '#F44336'],
        ];

        return $dailyChartOptions;
    }

   
    public function render()
    {
        return view('livewire.admin.stats.transactions');
    }
}
