@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <!-- Header Mock -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Dummy Payment Gateway</h2>
            <p class="text-slate-500 dark:text-slate-400">Environment Uji Coba</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <!-- Order Details -->
            <div class="p-6 md:p-8 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-500 hover:underline cursor-pointer">Order ID: #{{ $order->order_code }}</span>
                    <span class="text-2xl font-extrabold text-slate-900 dark:text-white">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                </div>
                <div class="text-sm font-medium text-slate-600 dark:text-slate-300">
                    {{ optional($order->package)->name ?? 'Custom Website Project' }}
                </div>
            </div>

            <!-- Simulation Form -->
            <form action="{{ route('dummy.payment.process', $order->id) }}" method="POST" class="p-6 md:p-8">
                @csrf

                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Pilih Metode Pembayaran</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <label class="relative flex cursor-pointer p-4 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 hover:border-blue-500 transition-colors has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                        <input type="radio" name="bank" value="BCA Virtual Account" class="peer sr-only" checked>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-700 dark:text-blue-300 font-bold">BCA</div>
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">BCA Virtual Account</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Otomatis</p>
                            </div>
                        </div>
                    </label>

                    <label class="relative flex cursor-pointer p-4 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 hover:border-blue-500 transition-colors has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                        <input type="radio" name="bank" value="Mandiri Virtual Account" class="peer sr-only">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center text-yellow-700 dark:text-yellow-300 font-bold text-xs shadow-inner">MANDIRI</div>
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">Mandiri VA</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Otomatis</p>
                            </div>
                        </div>
                    </label>
                    
                    <label class="relative flex cursor-pointer p-4 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 hover:border-blue-500 transition-colors has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                        <input type="radio" name="bank" value="QRIS" class="peer sr-only">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-red-100 dark:bg-red-900/50 flex items-center justify-center text-red-700 dark:text-red-300 font-bold text-xs">QRIS</div>
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">QRIS (Gopay/Ovo)</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Instan</p>
                            </div>
                        </div>
                    </label>

                    <label class="relative flex cursor-pointer p-4 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 hover:border-blue-500 transition-colors has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                        <input type="radio" name="bank" value="Credit Card" class="peer sr-only">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-slate-100 dark:bg-slate-600 flex items-center justify-center text-slate-700 dark:text-slate-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">Credit Card</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Visa / Mastercard</p>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="pt-6 border-t border-slate-200 dark:border-slate-700">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-4 uppercase tracking-wider">Aksi Simulasi Mode</h3>
                    
                    <div class="grid grid-cols-3 gap-3">
                        <button type="submit" name="status" value="success" class="flex flex-col items-center justify-center p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors">
                            <svg class="w-6 h-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="font-bold text-sm">Success</span>
                        </button>
                        
                        <button type="submit" name="status" value="pending" class="flex flex-col items-center justify-center p-4 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800 hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                            <svg class="w-6 h-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="font-bold text-sm">Pending</span>
                        </button>
                        
                        <button type="submit" name="status" value="failed" class="flex flex-col items-center justify-center p-4 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors">
                            <svg class="w-6 h-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            <span class="font-bold text-sm">Failed</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('my.orders') }}" class="text-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-amber-300">
                &larr; Batalkan Simulasi & Kembali
            </a>
        </div>
    </div>
</div>

@endsection
