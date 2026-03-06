<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;

class AdminController extends Controller
{

    public function index()
    {

        $totalOrders = Order::count();

        $totalRevenue = Order::where('status','paid')->sum('price');

        $totalPackages = Package::count();

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalPackages',
            'recentOrders'
        ));

    }

}