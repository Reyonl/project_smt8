@extends('layouts.app')

@section('content')

<div class="relative min-h-[50vh] flex items-center justify-center overflow-hidden mb-12 rounded-[2.5rem] bg-slate-900 border border-slate-800">
    <!-- Abstract Background -->
    <div class="absolute inset-0 bg-[url('{{ asset('storage/hero-bg.png') }}')] bg-cover bg-center opacity-30 mix-blend-luminosity"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-fuchsia-600/20 rounded-full blur-[120px] -z-10"></div>
    
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto py-20">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-6 backdrop-blur-md">
            <span class="text-xs font-semibold text-fuchsia-400 uppercase tracking-wider">Harga Web Agency</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-6">
            Pilih Paket <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-500">Website</span> Anda
        </h1>
        <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Investasi cerdas untuk pertumbuhan bisnis digital. Pembayaran mudah dan cepat, pantau status pesanan secara real-time.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    @if($packages->isEmpty())
        <div class="text-center py-24 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum Ada Paket</h3>
            <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto">Admin kami sedang menyiapkan paket-paket terbaik untuk Anda. Silakan kembali lagi nanti.</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($packages as $p)
                <div class="relative group h-full flex flex-col bg-white dark:bg-slate-900/50 rounded-3xl border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-2xl hover:shadow-fuchsia-500/10 transition-all duration-500 hover:-translate-y-2">
                    
                    <!-- Decorative Gradient -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-fuchsia-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="relative aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800">
                        @if($p->image_path)
                            <img
                                src="{{ asset('storage/' . $p->image_path) }}"
                                alt="Preview {{ $p->name }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-12 h-12 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-sm font-medium">Brosur Visual</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                        <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
                            <h2 class="text-2xl font-bold text-white tracking-tight">{{ $p->name }}</h2>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 flex-grow flex flex-col">
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-8 flex-grow">
                            {{ $p->description }}
                        </p>

                        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-5 mb-8 border border-slate-100 dark:border-slate-700/50">
                            <ul class="space-y-3">
                                <li class="flex items-center text-sm text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Desain UI/UX Modern & Responsif
                                </li>
                                <li class="flex items-center text-sm text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Optimasi Performa Dasar (Fast Load)
                                </li>
                                <li class="flex items-center text-sm text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Support Pasca Peluncuran
                                </li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between mt-auto">
                            <div>
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Investasi</p>
                                <p class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            @auth
                                <a href="{{ route('checkout', $p->id) }}" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-900 dark:bg-fuchsia-600 text-white hover:bg-slate-800 dark:hover:bg-fuchsia-500 transition-colors group/btn">
                                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                                    Login
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    <!-- CTA Custom Order -->
    <div class="mt-16 bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2.5rem] p-8 md:p-12 border border-slate-700 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-fuchsia-500/20 rounded-full blur-[80px]"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
            <div class="max-w-xl">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Butuh Fitur Spesifik?</h3>
                <p class="text-slate-400 text-lg">Pesan Custom Website yang dibangun 100% mengikuti visi dan alur bisnis Anda. Konsultasikan gratis bersama expert kami.</p>
            </div>
            <div>
                <a href="{{ route('custom.order') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-sm font-bold rounded-full bg-white text-slate-900 hover:bg-fuchsia-50 transition-all shadow-xl hover:shadow-white/20 hover:-translate-y-1">
                    Isi Form Custom Order
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
