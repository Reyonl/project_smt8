<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {

        $totalOrders = Order::count();

        $totalRevenue = Order::where('status','paid')->sum('price');

        $totalPackages = Package::count();

        $recentOrders = Order::latest()->take(5)->get();

        // --- Performa Bisnis Metrics ---
        // Growth Revenue (This Month vs Last Month)
        $thisMonthRevenue = Order::where('status', 'paid')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('price');
        $lastMonthRevenue = Order::where('status', 'paid')->whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->sum('price');
        $revenueGrowth = $lastMonthRevenue > 0 ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 100;

        // Growth Orders
        $thisMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
        $lastMonthOrders = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->count();
        $ordersGrowth = $lastMonthOrders > 0 ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : 100;

        // Average Order Value (AOV)
        $aov = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // --- Distribution Metrics ---
        // Package Distribution for Doughnut Chart
        $packageDistribution = Order::whereNotNull('package_id')
            ->select('package_id', DB::raw('count(*) as count'))
            ->groupBy('package_id')
            ->with('package:id,name')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->package->name,
                    'count' => $item->count
                ];
            });
        
        // Add Custom Order to distribution
        $customOrderCount = Order::whereNull('package_id')->count();
        if ($customOrderCount > 0) {
            $packageDistribution->push([
                'name' => 'Custom Website',
                'count' => $customOrderCount
            ]);
        }

        // Status Breakdown
        $statusBreakdown = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Data for Chart (Revenue & Order Counts)
        $dailyData = $this->getChartData('daily');
        $weeklyData = $this->getChartData('weekly');
        $monthlyData = $this->getChartData('monthly');

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalPackages',
            'recentOrders',
            'dailyData',
            'weeklyData',
            'monthlyData',
            'revenueGrowth',
            'ordersGrowth',
            'aov',
            'packageDistribution',
            'statusBreakdown'
        ));

    }

    private function getChartData($period)
    {
        $query = Order::where('status', 'paid');
        $labels = [];
        $revenue = [];
        $counts = [];

        if ($period === 'daily') {
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $labels[] = $date->format('d M');
                $data = (clone $query)->whereDate('created_at', $date)->selectRaw('COUNT(*) as count, SUM(price) as revenue')->first();
                $revenue[] = (float) ($data->revenue ?? 0);
                $counts[] = (int) ($data->count ?? 0);
            }
        } elseif ($period === 'weekly') {
            for ($i = 11; $i >= 0; $i--) {
                $start = Carbon::now()->subWeeks($i)->startOfWeek();
                $end = Carbon::now()->subWeeks($i)->endOfWeek();
                $labels[] = "M" . ($i + 1) . " (" . $start->format('d/m') . ")";
                $data = (clone $query)->whereBetween('created_at', [$start, $end])->selectRaw('COUNT(*) as count, SUM(price) as revenue')->first();
                $revenue[] = (float) ($data->revenue ?? 0);
                $counts[] = (int) ($data->count ?? 0);
            }
        } else { // monthly
            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $labels[] = $month->format('M Y');
                $data = (clone $query)->whereMonth('created_at', $month->month)->whereYear('created_at', $month->year)->selectRaw('COUNT(*) as count, SUM(price) as revenue')->first();
                $revenue[] = (float) ($data->revenue ?? 0);
                $counts[] = (int) ($data->count ?? 0);
            }
        }

        return [
            'labels' => $labels,
            'revenue' => $revenue,
            'counts' => $counts
        ];
    }
}