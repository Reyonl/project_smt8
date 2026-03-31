@extends('layouts.app')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

<div class="flex flex-col gap-8 py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-2">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Admin Panel Aktiv</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Admin Dashboard</h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Ringkasan bisnis dan performa layanan.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                Kelola Paket
            </a>
            <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                Lihat Orders
            </a>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-4">
        <!-- Card 1: Total Orders -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] p-6 border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Orders</p>
                    </div>
                </div>
                <p class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $totalOrders }}</p>
                @if($ordersGrowth != 0)
                    <div class="mt-2 flex items-center gap-1">
                        <span @class([
                            'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold',
                            'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400' => $ordersGrowth > 0,
                            'bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400' => $ordersGrowth < 0
                        ])>
                            {{ $ordersGrowth > 0 ? '+' : '' }}{{ number_format($ordersGrowth, 1) }}%
                        </span>
                        <span class="text-xs text-slate-500">vs bln lalu</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Card 2: Revenue -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] p-6 border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Revenue</p>
                    </div>
                </div>
                <p class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
                @if($revenueGrowth != 0)
                    <div class="mt-2 flex items-center gap-1">
                        <span @class([
                            'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold',
                            'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400' => $revenueGrowth > 0,
                            'bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400' => $revenueGrowth < 0
                        ])>
                            {{ $revenueGrowth > 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}%
                        </span>
                        <span class="text-xs text-slate-500">vs bln lalu</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Card 3: AOV -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] p-6 border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-amber-50 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Avg. Order Value</p>
                    </div>
                </div>
                <p class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    Rp {{ number_format($aov, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Performance Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden p-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Performa Bisnis</h2>
                    <p class="text-sm text-slate-500">Pendapatan & volume pesanan.</p>
                </div>
                <div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-xl" x-data="{ period: 'daily' }">
                    <button @click="period = 'daily'; updateChart('daily')" :class="period === 'daily' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-2 text-xs font-bold rounded-lg transition-all">Harian</button>
                    <button @click="period = 'weekly'; updateChart('weekly')" :class="period === 'weekly' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-2 text-xs font-bold rounded-lg transition-all">Mingguan</button>
                    <button @click="period = 'monthly'; updateChart('monthly')" :class="period === 'monthly' ? 'bg-white dark:bg-slate-700 shadow-sm text-slate-900 dark:text-white' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-2 text-xs font-bold rounded-lg transition-all">Bulanan</button>
                </div>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>

        <!-- Package Distribution -->
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden p-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Populeritas Paket</h2>
            <p class="text-sm text-slate-500 mb-8">Distribusi pesanan per jenis paket.</p>
            <div class="relative h-64 w-full">
                <canvas id="packageChart"></canvas>
            </div>
            <div class="mt-6 flex flex-col gap-2">
                @foreach($packageDistribution->take(4) as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600 dark:text-slate-400">{{ $item['name'] }}</span>
                        <span class="font-bold text-slate-900 dark:text-white">{{ $item['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3 mt-6">
        <!-- Status Breakdown -->
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden p-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Status Pesanan</h2>
            <div class="flex flex-col gap-4">
                @foreach($statusBreakdown as $sb)
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40">
                        <div class="flex items-center gap-3">
                            <span @class([
                                'w-3 h-3 rounded-full',
                                'bg-emerald-500' => $sb->status === 'paid',
                                'bg-blue-500' => $sb->status === 'pending_review',
                                'bg-amber-500' => $sb->status === 'pending',
                                'bg-rose-500' => !in_array($sb->status, ['paid', 'pending', 'pending_review'])
                            ])></span>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ ucfirst(str_replace('_', ' ', $sb->status)) }}</span>
                        </div>
                        <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $sb->count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Orders (Moved inside grid or kept outside) -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
        <div class="p-6 md:px-8 md:py-6 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <div class="flex items-center gap-3 mb-4 sm:mb-0">
                <div class="p-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Recent Orders</h2>
            </div>
            <a href="{{ route('admin.orders') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors uppercase tracking-wider">Lainnya →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Order Code</th>
                        <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">User ID</th>
                        <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                        <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($recentOrders as $o)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                            <td class="px-8 py-5 whitespace-nowrap">
                                <span class="font-mono text-sm font-bold text-slate-900 dark:text-white">{{ $o->order_code }}</span>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-bold">{{ substr($o->user->name ?? $o->user_id, 0, 1) }}</div>
                                    User #{{ $o->user_id }}
                                </div>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-slate-900 dark:text-white">
                                @if($o->price > 0)
                                    Rp {{ number_format($o->price, 0, ',', '.') }}
                                @else
                                    <span class="text-slate-400 italic font-normal">Belum diset</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap">
                                @if($o->status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                                    </span>
                                @elseif($o->status === 'pending_review')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Review
                                    </span>
                                @elseif($o->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ ucfirst($o->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap text-right text-sm text-slate-500">
                                {{ $o->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Belum ada Order</h3>
                                <p class="text-sm text-slate-500">Pesanan terbaru akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const chartData = {
        daily: @json($dailyData),
        weekly: @json($weeklyData),
        monthly: @json($monthlyData)
    };

    const packageData = @json($packageDistribution);

    let perfChart;
    let pkgChart;

    function initCharts(perfData, pkgData) {
        // Line Chart
        const ctxPerf = document.getElementById('performanceChart').getContext('2d');
        perfChart = new Chart(ctxPerf, {
            type: 'line',
            data: {
                labels: perfData.labels,
                datasets: [
                    {
                        label: 'Revenue (IDR)',
                        data: perfData.revenue,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Total Orders',
                        data: perfData.counts,
                        borderColor: '#6366f1',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        tension: 0.4,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: { display: false },
                        ticks: { callback: value => 'Rp ' + (value/1000000).toFixed(1) + 'jt' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: true },
                        min: 0
                    }
                },
                plugins: { legend: { display: false } }
            }
        });

        // Doughnut Chart
        const ctxPkg = document.getElementById('packageChart').getContext('2d');
        pkgChart = new Chart(ctxPkg, {
            type: 'doughnut',
            data: {
                labels: pkgData.map(i => i.name),
                datasets: [{
                    data: pkgData.map(i => i.count),
                    backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    function updateChart(period) {
        const data = chartData[period];
        perfChart.data.labels = data.labels;
        perfChart.data.datasets[0].data = data.revenue;
        perfChart.data.datasets[1].data = data.counts;
        perfChart.update();
    }

    document.addEventListener('DOMContentLoaded', () => {
        initCharts(chartData.daily, packageData);
    });
</script>
@endpush
