@extends('layouts.app')

@section('content')

@php
    $methodLabels = [
        'bank_transfer' => 'Transfer Bank',
        'e_wallet' => 'E-Wallet',
        'credit_card' => 'Kartu Kredit / Debit',
    ];
    $methodLabel = $methodLabels[$paymentMethod] ?? $paymentMethod;
@endphp

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-lg">

        {{-- Gateway Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 text-xs font-bold tracking-wider uppercase mb-4">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Sandbox / Simulasi
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Payment Gateway</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Simulasi pembayaran untuk testing lokal</p>
        </div>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl shadow-slate-300/30 dark:shadow-none border border-slate-200 dark:border-slate-800 overflow-hidden">

            {{-- Order Summary Bar --}}
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-700 px-6 py-5 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Pembayaran</p>
                        <p class="text-2xl font-extrabold tracking-tight mt-0.5">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Order</p>
                        <p class="text-sm font-mono font-semibold mt-0.5">{{ $order->order_code }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment Method Display --}}
            <div class="px-6 py-6 border-b border-slate-100 dark:border-slate-800">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Metode Pembayaran</p>

                @if($paymentMethod === 'bank_transfer')
                    <div class="bg-blue-50 dark:bg-blue-500/10 rounded-2xl p-5 border border-blue-100 dark:border-blue-500/20">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-md">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white text-sm">Transfer Bank — BCA</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Virtual Account</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-blue-200 dark:border-blue-500/20">
                            <p class="text-xs text-slate-500 mb-1 font-medium">Nomor Virtual Account</p>
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-mono font-extrabold text-blue-600 dark:text-blue-400 tracking-wider">8801 7788 {{ rand(1000, 9999) }} {{ rand(1000, 9999) }}</p>
                                <button type="button" onclick="copyVA(this)" class="text-xs bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 px-3 py-1.5 rounded-lg font-semibold hover:bg-blue-200 dark:hover:bg-blue-500/30 transition-colors">Copy</button>
                            </div>
                        </div>
                        <ol class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-400 list-decimal list-inside">
                            <li>Buka aplikasi m-Banking atau ATM</li>
                            <li>Pilih menu Transfer → Virtual Account</li>
                            <li>Masukkan nomor VA di atas</li>
                            <li>Konfirmasi pembayaran</li>
                        </ol>
                    </div>
                @elseif($paymentMethod === 'e_wallet')
                    <div class="bg-emerald-50 dark:bg-emerald-500/10 rounded-2xl p-5 border border-emerald-100 dark:border-emerald-500/20">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white shadow-md">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white text-sm">E-Wallet — GoPay</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Scan QR Code</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-emerald-200 dark:border-emerald-500/20 flex flex-col items-center">
                            {{-- Dummy QR Code using SVG --}}
                            <div class="w-48 h-48 bg-white rounded-2xl p-3 border-2 border-dashed border-slate-300 dark:border-slate-600 flex items-center justify-center relative">
                                <svg viewBox="0 0 200 200" class="w-full h-full">
                                    <rect x="10" y="10" width="50" height="50" fill="#1e293b" rx="5"/>
                                    <rect x="15" y="15" width="40" height="40" fill="white" rx="3"/>
                                    <rect x="22" y="22" width="26" height="26" fill="#1e293b" rx="2"/>
                                    <rect x="140" y="10" width="50" height="50" fill="#1e293b" rx="5"/>
                                    <rect x="145" y="15" width="40" height="40" fill="white" rx="3"/>
                                    <rect x="152" y="22" width="26" height="26" fill="#1e293b" rx="2"/>
                                    <rect x="10" y="140" width="50" height="50" fill="#1e293b" rx="5"/>
                                    <rect x="15" y="145" width="40" height="40" fill="white" rx="3"/>
                                    <rect x="22" y="152" width="26" height="26" fill="#1e293b" rx="2"/>
                                    @for($i = 0; $i < 20; $i++)
                                        <rect x="{{ rand(70, 130) }}" y="{{ rand(10, 180) }}" width="{{ rand(6, 12) }}" height="{{ rand(6, 12) }}" fill="#1e293b" rx="1"/>
                                    @endfor
                                    @for($i = 0; $i < 15; $i++)
                                        <rect x="{{ rand(10, 60) }}" y="{{ rand(70, 130) }}" width="{{ rand(6, 10) }}" height="{{ rand(6, 10) }}" fill="#1e293b" rx="1"/>
                                    @endfor
                                    @for($i = 0; $i < 15; $i++)
                                        <rect x="{{ rand(140, 190) }}" y="{{ rand(70, 130) }}" width="{{ rand(6, 10) }}" height="{{ rand(6, 10) }}" fill="#1e293b" rx="1"/>
                                    @endfor
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="bg-white rounded-lg p-1 shadow-sm">
                                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-md flex items-center justify-center text-white text-xs font-black">P</div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 text-xs text-slate-500 dark:text-slate-400 text-center">Scan menggunakan aplikasi GoPay, OVO, atau DANA</p>
                        </div>
                    </div>
                @elseif($paymentMethod === 'credit_card')
                    <div class="bg-fuchsia-50 dark:bg-fuchsia-500/10 rounded-2xl p-5 border border-fuchsia-100 dark:border-fuchsia-500/20">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center text-white shadow-md">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white text-sm">Kartu Kredit / Debit</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Visa, Mastercard, JCB</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">Nomor Kartu</label>
                                <input type="text" value="4811 1111 1111 1114" readonly class="w-full px-4 py-3 rounded-xl border border-fuchsia-200 dark:border-fuchsia-500/20 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-mono text-sm focus:outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">Expired</label>
                                    <input type="text" value="12/28" readonly class="w-full px-4 py-3 rounded-xl border border-fuchsia-200 dark:border-fuchsia-500/20 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-mono text-sm focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1.5">CVV</label>
                                    <input type="text" value="123" readonly class="w-full px-4 py-3 rounded-xl border border-fuchsia-200 dark:border-fuchsia-500/20 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-mono text-sm focus:outline-none">
                                </div>
                            </div>
                            <p class="text-xs text-fuchsia-600 dark:text-fuchsia-400 flex items-center gap-1.5 mt-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Data kartu dummy — untuk simulasi saja
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="px-6 py-6 space-y-3">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3 text-center">Pilih Hasil Simulasi</p>
                
                {{-- Success Button --}}
                <form action="{{ route('payment.process', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
                    <input type="hidden" name="status" value="success">
                    <button type="submit" class="w-full group relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-6 py-4 font-bold text-sm transition-all hover:shadow-xl hover:shadow-emerald-500/25 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        Simulasi Pembayaran Berhasil
                    </button>
                </form>

                {{-- Failed Button --}}
                <form action="{{ route('payment.process', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="{{ $paymentMethod }}">
                    <input type="hidden" name="status" value="failed">
                    <button type="submit" class="w-full group relative overflow-hidden rounded-xl bg-white dark:bg-slate-800 text-red-500 border-2 border-red-200 dark:border-red-500/30 px-6 py-4 font-bold text-sm transition-all hover:bg-red-50 dark:hover:bg-red-500/10 hover:border-red-400 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        Simulasi Pembayaran Gagal
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
                <div class="flex items-center justify-between text-xs text-slate-400">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Secure Gateway
                    </div>
                    <span class="font-mono">SANDBOX</span>
                </div>
            </div>

        </div>

        {{-- Back link --}}
        <div class="mt-6 text-center">
            <a href="{{ route('checkout.retry', $order->id) }}" class="inline-flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Checkout
            </a>
        </div>

    </div>
</div>

<script>
    function copyVA(btn) {
        var vaText = btn.parentElement.querySelector('.font-mono').textContent.trim();
        navigator.clipboard.writeText(vaText.replace(/\s/g, '')).then(function() {
            btn.textContent = 'Copied!';
            setTimeout(function() { btn.textContent = 'Copy'; }, 2000);
        });
    }
</script>

@endsection
