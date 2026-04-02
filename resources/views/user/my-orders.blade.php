@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Pesanan Saya</h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Kelola dan pantau seluruh transaksi website Anda.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('custom.order') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Order Custom
            </a>
            <a href="{{ route('packages') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold bg-slate-900 dark:bg-white text-white dark:text-slate-900 hover:opacity-90 transition-opacity">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Pesan Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-full text-emerald-600 dark:text-emerald-400 shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h4 class="font-semibold text-emerald-800 dark:text-emerald-400">Berhasil!</h4>
                <p class="text-emerald-600 dark:text-emerald-300 text-sm mt-1">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-8 p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-rose-100 dark:bg-rose-500/20 rounded-full text-rose-600 dark:text-rose-400 shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h4 class="font-semibold text-rose-800 dark:text-rose-400">Gagal</h4>
                <p class="text-rose-600 dark:text-rose-300 text-sm mt-1">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="mb-8 p-4 bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-blue-100 dark:bg-blue-500/20 rounded-full text-blue-600 dark:text-blue-400 shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h4 class="font-semibold text-blue-800 dark:text-blue-400">Informasi</h4>
                <p class="text-blue-600 dark:text-blue-300 text-sm mt-1">{{ session('info') }}</p>
            </div>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2rem] p-12 text-center shadow-xl shadow-slate-200/40 dark:shadow-none">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800 mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada transaksi</h3>
            <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto mb-8">Anda belum memiliki pesanan website. Mulai pilih paket atau buat pesanan custom Anda sekarang.</p>
            <a href="{{ route('packages') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-sm font-semibold rounded-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 transition-transform hover:scale-105">
                Mulai Eksplorasi
            </a>
        </div>
    @else
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                            <th class="px-6 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Detail Pesanan</th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @foreach($orders as $o)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors group">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 shrink-0 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden">
                                            @if($o->package && $o->package->image_path)
                                                <img src="{{ asset('storage/' . $o->package->image_path) }}" alt="" class="h-full w-full object-cover">
                                            @else
                                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-slate-900 dark:text-white">
                                                {{ optional($o->package)->name ?? 'Custom Website' }}
                                            </div>
                                            <div class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                                                <span class="font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-[10px]">{{ $o->order_code }}</span>
                                                <span>{{ $o->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-slate-900 dark:text-white">
                                        @if($o->price > 0)
                                            Rp {{ number_format($o->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-slate-500 italic font-normal">Menunggu Penawaran</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">ID: {{ optional($o->payment)->transaction_id ?? '-' }}</div>
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($o->status === 'paid')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                                        </span>
                                    @elseif($o->status === 'pending_review')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Direview Admin
                                        </span>
                                    @elseif($o->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu Bayar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ ucfirst($o->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        @if($o->status === 'pending' && $o->price > 0)
                                            <a href="{{ route('checkout.retry', $o->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg text-xs font-semibold hover:opacity-90 transition-opacity">
                                                Bayar Sekarang
                                            </a>
                                        @endif
                                        <a href="{{ route('order.show', $o->id) }}" class="text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2 text-xs font-semibold">
                                            Detail & Invoice
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@endsection
