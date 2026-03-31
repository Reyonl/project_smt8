@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8 text-center md:text-left flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">Checkout</h1>
            <p class="mt-2 text-lg text-slate-600 dark:text-slate-400">Selesaikan pembayaran untuk memulai projek Anda bersama kami.</p>
        </div>
        <a href="{{ route('my.orders') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            Pesanan Saya
        </a>
    </div>

    <form id="checkout-form" action="{{ route('payment.simulate', $order->id) }}" method="POST">
        @csrf
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

                    <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800/50">
                        <label for="notes_awal" class="block text-sm font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Ide / Gambaran Website Singkat (Opsional)
                        </label>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Tulis sedikit deskripsi web seperti apa yang Anda harapkan (Form lengkapnya nanti menyusul).</p>
                        <textarea id="notes_awal" name="notes_awal" rows="3" class="w-full rounded-2xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-4 placeholder-slate-400" placeholder="Misalnya: Saya butuh web profil untuk bengkel modifikasi motor..."></textarea>
                    </div>
                </div>

                <!-- Right Column: Payment Method Selection -->
                <div class="md:col-span-2 p-8 md:p-10 bg-slate-50 dark:bg-slate-800/30 flex flex-col">
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">Pilih Metode Pembayaran</h3>
                        </div>
                    </div>

                    <div class="space-y-3 flex-1">
                        <!-- Bank Transfer -->
                        <label id="method-bank_transfer" class="payment-method-card group relative flex items-center gap-4 p-4 rounded-2xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 cursor-pointer transition-all duration-200 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-md" onclick="selectMethod('bank_transfer')">
                            <input type="radio" name="payment_method" value="bank_transfer" class="sr-only peer" required>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/25 shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">Transfer Bank</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">BCA, BNI, Mandiri, BRI</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-all flex items-center justify-center shrink-0 method-radio">
                                <svg class="w-3 h-3 text-white opacity-0 method-check" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label id="method-e_wallet" class="payment-method-card group relative flex items-center gap-4 p-4 rounded-2xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 cursor-pointer transition-all duration-200 hover:border-emerald-400 dark:hover:border-emerald-500 hover:shadow-md" onclick="selectMethod('e_wallet')">
                            <input type="radio" name="payment_method" value="e_wallet" class="sr-only peer" required>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/25 shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">E-Wallet</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">GoPay, OVO, DANA, ShopeePay</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 transition-all flex items-center justify-center shrink-0 method-radio">
                                <svg class="w-3 h-3 text-white opacity-0 method-check" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </label>

                        <!-- Credit Card -->
                        <label id="method-credit_card" class="payment-method-card group relative flex items-center gap-4 p-4 rounded-2xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 cursor-pointer transition-all duration-200 hover:border-fuchsia-400 dark:hover:border-fuchsia-500 hover:shadow-md" onclick="selectMethod('credit_card')">
                            <input type="radio" name="payment_method" value="credit_card" class="sr-only peer" required>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-fuchsia-500/25 shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">Kartu Kredit / Debit</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Visa, Mastercard, JCB</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 peer-checked:border-fuchsia-500 peer-checked:bg-fuchsia-500 transition-all flex items-center justify-center shrink-0 method-radio">
                                <svg class="w-3 h-3 text-white opacity-0 method-check" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </label>
                    </div>

                    <div class="mt-6 space-y-4">
                        <button id="pay-button" type="submit" disabled class="w-full relative group overflow-hidden rounded-xl bg-slate-300 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-8 py-4 font-bold text-center transition-all cursor-not-allowed flex justify-center items-center">
                            <span id="pay-label" class="relative z-10 flex items-center gap-2">
                                Pilih Metode Pembayaran
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                            <!-- Hover effect gradient -->
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-fuchsia-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 hidden dark:block"></div>
                        </button>
                        
                        <div class="flex items-center justify-center gap-4 opacity-50 mt-4">
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                SECURE GATEWAY
                            </div>
                            <div class="w-1 h-1 rounded-full bg-slate-400"></div>
                            <div class="text-xs text-slate-500 font-medium">SANDBOX MODE</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    
    <div class="mt-8 text-center">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Punya pertanyaan sebelum membayar? <a href="#" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Hubungi support kami</a>
        </p>
    </div>
</div>

<script>
    function selectMethod(method) {
        // Remove active state from all cards
        document.querySelectorAll('.payment-method-card').forEach(function(card) {
            card.classList.remove('border-blue-500', 'border-emerald-500', 'border-fuchsia-500', 'dark:border-blue-500', 'dark:border-emerald-500', 'dark:border-fuchsia-500', 'shadow-lg', 'scale-[1.02]');
            card.classList.add('border-slate-200', 'dark:border-slate-700');
            card.querySelector('.method-radio').classList.remove('border-blue-500', 'bg-blue-500', 'border-emerald-500', 'bg-emerald-500', 'border-fuchsia-500', 'bg-fuchsia-500');
            card.querySelector('.method-radio').classList.add('border-slate-300', 'dark:border-slate-600');
            card.querySelector('.method-check').classList.add('opacity-0');
        });

        // Set active state on selected card
        var colors = {
            'bank_transfer': { border: 'border-blue-500', darkBorder: 'dark:border-blue-500', radio: ['border-blue-500', 'bg-blue-500'] },
            'e_wallet': { border: 'border-emerald-500', darkBorder: 'dark:border-emerald-500', radio: ['border-emerald-500', 'bg-emerald-500'] },
            'credit_card': { border: 'border-fuchsia-500', darkBorder: 'dark:border-fuchsia-500', radio: ['border-fuchsia-500', 'bg-fuchsia-500'] }
        };

        var selected = document.getElementById('method-' + method);
        var color = colors[method];
        selected.classList.remove('border-slate-200', 'dark:border-slate-700');
        selected.classList.add(color.border, color.darkBorder, 'shadow-lg', 'scale-[1.02]');
        selected.querySelector('.method-radio').classList.remove('border-slate-300', 'dark:border-slate-600');
        selected.querySelector('.method-radio').classList.add(...color.radio);
        selected.querySelector('.method-check').classList.remove('opacity-0');

        // Enable button
        var btn = document.getElementById('pay-button');
        btn.disabled = false;
        btn.classList.remove('bg-slate-300', 'dark:bg-slate-700', 'text-slate-500', 'dark:text-slate-400', 'cursor-not-allowed');
        btn.classList.add('bg-slate-900', 'dark:bg-white', 'text-white', 'dark:text-slate-900', 'hover:scale-[1.02]', 'hover:shadow-xl', 'shadow-slate-900/20', 'cursor-pointer');
        document.getElementById('pay-label').innerHTML = 'Bayar Sekarang <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>';
    }
</script>

@endsection
