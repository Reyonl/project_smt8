@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        
        <!-- Header Mock -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Pembayaran Transfer Bank</h2>
            <p class="text-slate-500 dark:text-slate-400">Instruksi Pembayaran Manual</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
            <!-- Order Details -->
            <div class="p-6 md:p-8 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-500">Order ID: #{{ $order->order_code }}</span>
                    <span class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                </div>
                <div class="text-sm font-medium text-slate-600 dark:text-slate-300">
                    Total tagihan untuk {{ optional($order->package)->name ?? 'Custom Website Project' }}
                </div>
            </div>

            <!-- Rekening Admin -->
            <div class="p-6 md:p-8 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Transfer ke Rekening Berikut:</h3>
                
                <div class="bg-slate-100 dark:bg-slate-700 rounded-xl p-6 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-16 h-16 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg flex-shrink-0 text-xl">BCA</div>
                    <div class="flex-grow">
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Nomor Rekening</p>
                        <div class="flex items-center gap-3">
                            <p class="text-2xl font-mono font-bold text-slate-900 dark:text-white tracking-widest">731 025 2110</p>
                            <button onclick="navigator.clipboard.writeText('7310252110')" class="text-xs px-3 py-1 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded drop-shadow-sm hover:bg-slate-50 active:scale-95 transition-transform text-slate-700 dark:text-slate-300">Copy</button>
                        </div>
                        <p class="mt-2 font-medium text-slate-700 dark:text-slate-300">a.n Jasa Website Indonesia</p>
                    </div>
                </div>
                
                <p class="mt-4 text-sm text-amber-600 dark:text-amber-400 flex items-center gap-2 bg-amber-50 dark:bg-amber-900/20 p-3 rounded-lg border border-amber-200 dark:border-amber-800">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Pastikan jumlah transfer tepat hingga 3 digit terakhir untuk mempercepat verifikasi.
                </p>
            </div>

            <!-- Upload Form -->
            <form action="{{ route('payment.manual.process', $order->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf

                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Konfirmasi Pembayaran</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Jika sudah melakukan transfer, silakan upload bukti struk / screenshot M-Banking Anda di bawah ini.</p>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Upload Bukti Transfer</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 dark:border-slate-600 border-dashed rounded-xl bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                                <label for="proof_image" class="relative cursor-pointer bg-white dark:bg-slate-800 rounded-md font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1">
                                    <span>Pilih File</span>
                                    <input id="proof_image" name="proof_image" type="file" accept="image/*" class="sr-only" required>
                                </label>
                                <p class="pl-1 py-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-500">PNG, JPG, GIF up to 5MB</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Kirim Bukti Pembayaran
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('my.orders') }}" class="text-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-amber-300">
                &larr; Bayar Nanti (Kembali)
            </a>
        </div>
    </div>
</div>

<script>
    document.getElementById('proof_image').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        if(nextSibling) nextSibling.innerText = fileName;
        // Optionally show image preview
    });
</script>

@endsection
