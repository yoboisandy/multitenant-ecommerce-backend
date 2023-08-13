<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }
    public function getDashboardStats(Request $request)
    {
        $totalRevenue = Order::whereNotIn('order_status', ['cancelled', 'returned'])
            ->whereDate('created_at', date('Y-m-d'))
            ->sum('total_price');
        $totalOrders = Order::whereNotIn('order_status', ['cancelled', 'returned'])
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        $hourlyOrders = Order::selectRaw('count(*) as count, HOUR(created_at) as hour')
            ->whereNotIn('order_status', ['cancelled', 'returned'])
            ->whereDate('created_at', date('Y-m-d'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
        $hourlyOrders = collect(range(0, 23))->map(function ($hour) use ($hourlyOrders) {
            $hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
            return [
                'hour' => $hour . ':00',
                'count' => $hourlyOrders->where('hour', $hour)->first()->count ?? 0,
            ];
        });

        // weekly sales of this week
        $weeklySales = Order::selectRaw('sum(total_price) as total, DAYNAME(created_at) as day')
            ->whereNotIn('order_status', ['cancelled', 'returned'])
            ->whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $weeklySales = collect([
            ['day' => 'Monday', 'total' => 0],
            ['day' => 'Tuesday', 'total' => 0],
            ['day' => 'Wednesday', 'total' => 0],
            ['day' => 'Thursday', 'total' => 0],
            ['day' => 'Friday', 'total' => 0],
            ['day' => 'Saturday', 'total' => 0],
            ['day' => 'Sunday', 'total' => 0],
        ])->map(function ($day) use ($weeklySales) {
            $day['total'] = floor($weeklySales->where('day', $day['day'])->first()->total ?? 0);
            return $day;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'totalRevenue' => floor($totalRevenue),
                'totalOrders' => $totalOrders,
                'avgOrderValue' => floor($avgOrderValue),
                'hourlyOrders' => $hourlyOrders,
                'weeklySales' => $weeklySales,
                'topProducts' => $this->orderService->getTrendingProducts()
            ]
        ]);
    }
}
