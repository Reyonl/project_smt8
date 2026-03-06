@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Admin Dashboard</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Ringkasan bisnis dan quick actions.</p>
        </div>
        <div class="flex flex-col gap-2 sm:flex-row">
            <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Kelola Paket</a>
            <a href="{{ route('admin.orders') }}" class="btn btn-primary">Lihat Orders</a>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="card">
            <div class="card-body">
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Orders</p>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">{{ $totalOrders }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Revenue (paid)</p>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-indigo-600 dark:text-indigo-300">Rp {{ number_format($totalRevenue) }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Packages</p>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">{{ $totalPackages }}</p>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="card-body flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-900 dark:text-slate-50">Recent Orders</h2>
            <a href="{{ route('admin.orders') }}" class="btn btn-outline">Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $o)
                        <tr>
                            <td class="font-medium text-slate-900 dark:text-slate-50">{{ $o->order_code }}</td>
                            <td class="text-slate-700 dark:text-slate-200">{{ $o->user_id }}</td>
                            <td class="text-slate-700 dark:text-slate-200">Rp {{ number_format($o->price) }}</td>
                            <td>
                                @if($o->status === 'paid')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($o->status === 'pending')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-danger">{{ ucfirst($o->status) }}</span>
                                @endif
                            </td>
                            <td class="text-slate-700 dark:text-slate-200">{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-600 dark:text-slate-300">Belum ada order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


