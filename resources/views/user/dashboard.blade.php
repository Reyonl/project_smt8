@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                Selamat datang, {{ auth()->user()->name }}! 👋
            </h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Pantau pesanan website Anda dan kelola semua projek dari sini.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('packages') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Pesan Website Baru
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid gap-6 md:grid-cols-4 mb-8">
        {{-- Total Pesanan --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pesanan</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalOrders }}</p>
            </div>
        </div>

        {{-- Sedang Diproses --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-amber-50 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Menunggu Bayar</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $pendingOrders }}</p>
            </div>
        </div>

        {{-- Lunas --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Lunas</p>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $paidOrders }}</p>
            </div>
        </div>

        {{-- Total Investasi --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-fuchsia-500/10 rounded-full blur-2xl -mr-6 -mt-6"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2.5 bg-fuchsia-50 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Investasi</p>
                </div>
                <p class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-blue-600 dark:from-fuchsia-400 dark:to-blue-400">
                    Rp {{ number_format($totalSpent, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Recent Orders --}}
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-5 flex items-center justify-between border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white">Pesanan Terbaru</h2>
                </div>
                <a href="{{ route('my.orders') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline uppercase tracking-wider">Lihat Semua →</a>
            </div>

            @if($recentOrders->isEmpty())
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Belum ada pesanan</h3>
                    <p class="text-sm text-slate-500 mb-4">Mulai dengan memilih paket website yang sesuai.</p>
                    <a href="{{ route('packages') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">Lihat Paket →</a>
                </div>
            @else
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($recentOrders as $o)
                        <a href="{{ route('order.show', $o->id) }}" class="flex items-center gap-4 px-5 py-4 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                            <div class="h-10 w-10 shrink-0 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden">
                                @if($o->package && $o->package->image_path)
                                    <img src="{{ asset('storage/' . $o->package->image_path) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ optional($o->package)->name ?? 'Custom Website' }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $o->created_at->format('d M Y') }} · Rp {{ number_format($o->price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                @if($o->status === 'paid')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                                    </span>
                                @elseif($o->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                        {{ ucfirst($o->status) }}
                                    </span>
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Quick Actions + Account Info --}}
        <div class="space-y-6">
            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Aksi Cepat
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('packages') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group">
                        <div class="p-2 bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Pilih Paket Website</p>
                            <p class="text-xs text-slate-500">Landing, Company Profile, dll</p>
                        </div>
                    </a>
                    <a href="{{ route('custom.order') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group">
                        <div class="p-2 bg-fuchsia-50 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 rounded-lg group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Order Custom</p>
                            <p class="text-xs text-slate-500">Website sesuai kebutuhan Anda</p>
                        </div>
                    </a>
                    <a href="{{ route('my.orders') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors group">
                        <div class="p-2 bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-lg group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Semua Pesanan</p>
                            <p class="text-xs text-slate-500">Riwayat & status pesanan</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Account Card --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-5">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Akun</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-slate-500 dark:text-slate-400">Nama</span>
                        <span class="font-medium text-slate-900 dark:text-white">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-slate-500 dark:text-slate-400">Email</span>
                        <span class="font-medium text-slate-900 dark:text-white text-xs">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ route('profile.edit') }}" class="block w-full text-center px-4 py-2.5 text-sm font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl hover:opacity-90 transition-opacity">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
