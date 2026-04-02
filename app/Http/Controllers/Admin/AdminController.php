<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status','paid')->sum('price');
        $totalPackages = Package::count();
        $pendingOrders = Order::where('status','pending')->count();
        $paidOrders = Order::where('status','paid')->count();
        $failedOrders = Order::where('status','failed')->count();
        $reviewOrders = Order::where('status','pending_review')->count();

        // Monthly revenue (last 6 months)
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Order::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('price');
            $monthlyRevenue[] = [
                'month' => $date->translatedFormat('M Y'),
                'revenue' => $revenue,
            ];
        }

        // Orders this month
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $revenueThisMonth = Order::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price');

        $recentOrders = Order::with('user', 'package')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalPackages',
            'pendingOrders',
            'paidOrders',
            'failedOrders',
            'reviewOrders',
            'monthlyRevenue',
            'ordersThisMonth',
            'revenueThisMonth',
            'recentOrders'
        ));
    }

    /**
     * Printable report page for admin
     */
    public function report()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status','paid')->sum('price');
        $pendingOrders = Order::where('status','pending')->count();
        $paidOrders = Order::where('status','paid')->count();
        $failedOrders = Order::where('status','failed')->count();

        $orders = Order::with('user', 'package', 'payment')->latest()->get();

        // Monthly summary
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthOrders = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
            $monthlyRevenue[] = [
                'month' => $date->translatedFormat('F Y'),
                'total_orders' => (clone $monthOrders)->count(),
                'paid_orders' => (clone $monthOrders)->where('status', 'paid')->count(),
                'revenue' => (clone $monthOrders)->where('status', 'paid')->sum('price'),
            ];
        }

        return view('admin.report', compact(
            'totalOrders', 'totalRevenue', 'pendingOrders', 'paidOrders', 'failedOrders',
            'orders', 'monthlyRevenue'
        ));
    }

}