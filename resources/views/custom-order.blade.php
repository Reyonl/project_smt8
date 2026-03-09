@extends('layouts.app')

@section('content')

<div class="relative min-h-[40vh] flex items-center justify-center overflow-hidden mb-12 rounded-[2.5rem] bg-slate-900 border border-slate-800">
    <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-900/40 to-blue-900/40 opacity-50 mix-blend-overlay"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-600/10 rounded-full blur-[100px] -z-10"></div>
    
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto py-16">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-6 backdrop-blur-md">
            <span class="text-xs font-semibold text-emerald-400 uppercase tracking-wider">Premium Custom Build</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white mb-4">
            Wujudkan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-blue-500">Visi Digital</span> Anda
        </h1>
        <p class="text-lg text-slate-300 mx-auto leading-relaxed">
            Ceritakan kebutuhan unik bisnis Anda. Tim kami akan merancang arsitektur dan desain web eksklusif yang tidak ada bandingannya.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl flex items-start gap-4">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-full text-emerald-600 dark:text-emerald-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-emerald-800 dark:text-emerald-400">Pengajuan Berhasil Terkirim!</h4>
                    <p class="text-emerald-600 dark:text-emerald-300 text-sm mt-1">{{ session('success') }}</p>
                    <div class="mt-4">
                        <a href="{{ route('my.orders') }}" class="text-sm font-medium underline text-emerald-700 dark:text-emerald-400 hover:text-emerald-900">Lihat Status Pesanan Saya</a>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('custom.order.store') }}" method="POST">
            @csrf
            
            <div class="space-y-8">
                <!-- Section 1 -->
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-800 pb-2">1. Informasi Proyek</h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Proyek / Perusahaan *</label>
                            <input type="text" name="project_name" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" placeholder="Misal: Sistem Kasir Toko Bunga">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategori Proyek *</label>
                            <select name="category" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="E-Commerce / Toko Online">E-Commerce / Toko Online</option>
                                <option value="Company Profile Premium">Company Profile Premium</option>
                                <option value="Sistem Informasi / Web App">Sistem Informasi / Web App (SaaS)</option>
                                <option value="Portal Berita / Blog">Portal Berita / Media</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-800 pb-2">2. Detail Kebutuhan Khusus</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Deskripsikan Fitur yang Anda Inginkan *</label>
                            <textarea name="description" rows="5" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" placeholder="Contoh: Saya membutuhkan website e-commerce yang memiliki fitur perhitungan ongkir otomatis, notifikasi WhatsApp saat ada pesanan, dan filter pencarian produk yang kompleks..."></textarea>
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Semakin detail, semakin akurat estimasi harga yang akan kami berikan.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Estimasi Anggaran (Opsional)</label>
                            <select name="budget" class="w-full md:w-1/2 rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow">
                                <option value="">Draft Anggaran</option>
                                <option value="< Rp 3.000.000">Kurang dari Rp 3.000.000</option>
                                <option value="Rp 3.000.000 - Rp 5.000.000">Rp 3.000.000 - Rp 5.000.000</option>
                                <option value="Rp 5.000.000 - Rp 15.000.000">Rp 5.000.000 - Rp 15.000.000</option>
                                <option value="> Rp 15.000.000">Lebih dari Rp 15.000.000</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-2xl p-6 border border-slate-100 dark:border-slate-700/50">
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        <b>Informasi:</b><br>
                        Pengajuan ini bersifat gratis dan tidak mengikat. Tim kami akan mereview kebutuhan Anda dan mengirimkan proposal harga melalui dashboard pesanan (status: Pending Review) dalam 1x24 jam kerja.
                    </p>
                    
                    <button type="submit" class="w-full flex justify-center items-center gap-2 px-8 py-4 text-sm font-bold rounded-xl bg-gradient-to-r from-emerald-500 to-blue-500 text-white hover:opacity-90 transition-all shadow-lg hover:shadow-emerald-500/25">
                        Kirim Form Pengajuan
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
