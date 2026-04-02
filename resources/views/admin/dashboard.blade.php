@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-8 py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Admin Panel</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Dashboard Admin</h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Ringkasan bisnis, performa layanan, dan pelaporan.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.report') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak Laporan
            </a>
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                Kelola Paket
            </a>
            <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                Lihat Semua Orders
            </a>
        </div>
    </div>

    {{-- Stat Cards Row 1 --}}
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        {{-- Total Orders --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Orders</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalOrders }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $ordersThisMonth }} pesanan bulan ini</p>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Revenue</p>
                </div>
                <p class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
                <p class="text-xs text-slate-500 mt-1">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }} bulan ini</p>
            </div>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-amber-50 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Menunggu Bayar</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $pendingOrders }}</p>
                @if($reviewOrders > 0)
                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 font-medium">+ {{ $reviewOrders }} butuh review</p>
                @endif
            </div>
        </div>

        {{-- Total Packages --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-fuchsia-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-fuchsia-50 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Paket Tersedia</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalPackages }}</p>
            </div>
        </div>
    </div>

    {{-- Quick Status Overview --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Distribusi Status Order</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl border border-emerald-100 dark:border-emerald-500/20">
                <p class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">{{ $paidOrders }}</p>
                <p class="text-xs font-medium text-emerald-600 dark:text-emerald-500 mt-1">Lunas</p>
            </div>
            <div class="text-center p-4 bg-amber-50 dark:bg-amber-500/10 rounded-xl border border-amber-100 dark:border-amber-500/20">
                <p class="text-2xl font-extrabold text-amber-700 dark:text-amber-400">{{ $pendingOrders }}</p>
                <p class="text-xs font-medium text-amber-600 dark:text-amber-500 mt-1">Pending</p>
            </div>
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-500/10 rounded-xl border border-blue-100 dark:border-blue-500/20">
                <p class="text-2xl font-extrabold text-blue-700 dark:text-blue-400">{{ $reviewOrders }}</p>
                <p class="text-xs font-medium text-blue-600 dark:text-blue-500 mt-1">Review</p>
            </div>
            <div class="text-center p-4 bg-rose-50 dark:bg-rose-500/10 rounded-xl border border-rose-100 dark:border-rose-500/20">
                <p class="text-2xl font-extrabold text-rose-700 dark:text-rose-400">{{ $failedOrders }}</p>
                <p class="text-xs font-medium text-rose-600 dark:text-rose-500 mt-1">Gagal</p>
            </div>
        </div>
    </div>

    {{-- Revenue Chart (simple bar chart using CSS) --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Pendapatan 6 Bulan Terakhir</h3>
        </div>
        @php $maxRevenue = max(array_column($monthlyRevenue, 'revenue')) ?: 1; @endphp
        <div class="flex items-end gap-3 h-48">
            @foreach($monthlyRevenue as $mr)
                <div class="flex-1 flex flex-col items-center gap-2">
                    <p class="text-[10px] font-bold text-slate-600 dark:text-slate-400">
                        @if($mr['revenue'] > 0) Rp {{ number_format($mr['revenue'] / 1000, 0) }}K @else - @endif
                    </p>
                    <div class="w-full rounded-t-lg transition-all duration-500 {{ $mr['revenue'] > 0 ? 'bg-gradient-to-t from-blue-600 to-blue-400 dark:from-blue-500 dark:to-blue-300' : 'bg-slate-200 dark:bg-slate-700' }}"
                         style="height: {{ max(($mr['revenue'] / $maxRevenue) * 100, 4) }}%">
                    </div>
                    <p class="text-[10px] text-slate-500 font-medium">{{ $mr['month'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-5 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <div class="flex items-center gap-3 mb-3 sm:mb-0">
                <div class="p-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Pesanan Terbaru</h2>
            </div>
            <a href="{{ route('admin.orders') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors uppercase tracking-wider">Semua Pesanan →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Order Code</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($recentOrders as $o)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $o->id) }}" class="font-mono text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">{{ $o->order_code }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-600 dark:text-slate-300">{{ substr(optional($o->user)->name ?? 'U', 0, 1) }}</div>
                                    <span class="font-medium text-slate-900 dark:text-white">{{ optional($o->user)->name ?? 'User #'.$o->user_id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 dark:text-slate-300 font-medium">
                                {{ optional($o->package)->name ?? 'Custom' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900 dark:text-white">
                                @if($o->price > 0) Rp {{ number_format($o->price, 0, ',', '.') }} @else <span class="text-slate-400 italic font-normal">—</span> @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($o->status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas</span>
                                @elseif($o->status === 'pending_review')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Review</span>
                                @elseif($o->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400"><span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ ucfirst($o->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs text-slate-500">
                                {{ $o->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="text-sm text-slate-500">Belum ada pesanan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
