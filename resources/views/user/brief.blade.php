@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-10 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-fuchsia-100 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 mb-6 border-4 border-white dark:border-slate-900 shadow-xl shadow-fuchsia-500/20">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        </div>
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-4">Brief Project Website Anda</h1>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
            Terima kasih telah mempercayakan pembuatan website Anda kepada kami! Untuk memulai pengerjaan pesanan <strong>{{ $order->order_code }}</strong>, mohon isi panduan kebutuhan berikut ini.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-8 p-6 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-rose-100 dark:bg-rose-500/20 rounded-full text-rose-600 dark:text-rose-400 shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-rose-800 dark:text-rose-300 font-extrabold text-base mb-2">Mohon periksa kembali input Anda:</p>
                <ul class="list-disc pl-5 space-y-1 text-sm text-rose-700 dark:text-rose-400">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-2xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
        <!-- Progress Indicator (Decorative) -->
        <div class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 p-6 md:px-10 flex items-center justify-between">
            <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Tahap 1 dari 1</span>
            <div class="w-32 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                <div class="h-full w-1/2 bg-gradient-to-r from-fuchsia-500 to-blue-500 rounded-full"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('order.brief.submit', $order->id) }}" class="p-6 md:p-10 space-y-8">
            @csrf

            <!-- Section 1 -->
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 text-sm">1</span>
                    Profil Bisnis / Konsep
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Nama Perusahaan / Merk / Judul Website <span class="text-rose-500">*</span>
                        </label>
                        <input name="company_name" value="{{ old('company_name') }}" required 
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" 
                            placeholder="Contoh: PT. Abadi Sentosa / Toko Roti Manis" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Bidang Usaha (Jenis/Kategori) <span class="text-rose-500">*</span>
                        </label>
                        <input name="business_type" value="{{ old('business_type') }}" required 
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" 
                            placeholder="Contoh: Restoran Makanan Laut, Agency Pemasaran, Toko Pakaian" />
                    </div>
                </div>
            </div>

            <hr class="border-slate-200 dark:border-slate-800">

            <!-- Section 2 -->
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm">2</span>
                    Preferensi Visual & Desain
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Warna Utama dan Warna Kesukaan
                        </label>
                        <input name="favorite_colors" value="{{ old('favorite_colors') }}" 
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" 
                            placeholder="Contoh: Biru Dongker dan Putih, Elegan dan Bersih" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Referensi Desain / Website Lain yang Disukai (Opsional)
                        </label>
                        <textarea name="design_preferences" rows="3" 
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" 
                            placeholder="Jelaskan atau sertakan link website yang gaya desainnya Anda sukai. (Misal: www.tokopedia.com atau desain yang minimalis)">{{ old('design_preferences') }}</textarea>
                    </div>
                </div>
            </div>

            <hr class="border-slate-200 dark:border-slate-800">

            <!-- Section 3 -->
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 text-sm">3</span>
                    Catatan Tambahan
                </h3>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Pesan Khusus, Fitur Spesifik, atau Detail Kontak (Opsional)
                    </label>
                    <textarea name="additional_notes" rows="4" 
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" 
                        placeholder="Ada hal spesifik yang ingin ditambah? Tuliskan di sini.">{{ old('additional_notes') }}</textarea>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-t border-slate-200 dark:border-slate-800">
                <a href="{{ route('order.show', $order->id) }}" class="text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 text-sm font-semibold flex items-center gap-2 transition-colors">
                    Nanti Saja (Kembali)
                </a>
                <button type="submit" class="inline-flex justify-center items-center px-8 py-4 rounded-2xl bg-gradient-to-r from-fuchsia-600 to-blue-600 text-white font-extrabold text-sm hover:from-fuchsia-500 hover:to-blue-500 focus:ring-4 focus:ring-fuchsia-500/30 transition-all shadow-xl shadow-fuchsia-500/25">
                    Kirim Brief & Mulai Pengerjaan →
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
