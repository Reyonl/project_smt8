@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8 text-center md:text-left flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">Checkout</h1>
            <p class="mt-2 text-lg text-slate-600 dark:text-slate-400">Selesaikan pesanan Anda untuk memulai projek bersama kami.</p>
        </div>
        <a href="{{ route('my.orders') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            Pesanan Saya
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="grid md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-200 dark:divide-slate-800">
            
            <!-- Left Column: Package Details -->
            <div class="md:col-span-3 p-8 md:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Ringkasan Pesanan</h2>
                </div>

                @if(optional($order->package)->image_path)
                    <div class="mb-8 overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 relative group">
                        <img
                            src="{{ asset('storage/' . $order->package->image_path) }}"
                            alt="Preview {{ optional($order->package)->name }}"
                            class="aspect-video w-full object-cover transition duration-500 group-hover:scale-105"
                            loading="lazy"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-semibold shadow-sm border border-white/10">Paket Terpilih</span>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Item</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ optional($order->package)->name ?? 'Custom Website' }}</p>
                    </div>
                    
                    <div class="pt-6 border-t border-slate-200 dark:border-slate-800/50">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Kode Transaksi</p>
                        <p class="font-medium text-slate-700 dark:text-slate-300 font-mono text-sm bg-slate-50 dark:bg-slate-800/50 inline-block px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700/50">{{ $order->order_code }}</p>
                    </div>

                    <div class="pt-6 border-t border-slate-200 dark:border-slate-800/50 flex items-center justify-between">
                        <p class="text-slate-600 dark:text-slate-400 font-medium">Total Pembayaran</p>
                        <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-fuchsia-600 dark:from-blue-400 dark:to-fuchsia-500">
                            Rp {{ number_format($order->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Action -->
            <div class="md:col-span-2 p-8 md:p-10 bg-slate-50 dark:bg-slate-800/30 flex flex-col justify-center">
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Lanjutkan Pesanan</h3>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Silakan lanjutkan ke halaman konfirmasi untuk menyelesaikan pesanan menggunakan Gateway Simulasi.
                    </p>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('payment.manual', $order->id) }}" class="w-full relative group overflow-hidden rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-8 py-4 font-bold text-center transition-all hover:scale-[1.02] hover:shadow-xl shadow-slate-900/20 focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 flex justify-center items-center">
                        <span class="relative z-10 flex items-center gap-2">
                            Arahkan ke Pembayaran
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-fuchsia-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 hidden dark:block"></div>
                    </a>
                    
                    <div class="flex items-center justify-center gap-4 opacity-50 grayscale mt-6">
                        <div class="text-xs font-bold font-mono tracking-wider">MANUAL</div>
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                        <div class="text-xs font-bold tracking-wider">TRANSFER</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="mt-8 text-center">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Punya pertanyaan sebelum membayar? <a href="#" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Hubungi support kami</a>
        </p>
    </div>
</div>

@endsection
