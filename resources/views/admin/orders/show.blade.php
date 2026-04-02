@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-4">
                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Order Detail</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Pesanan {{ $order->order_code }}</h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Rincian pesanan pelanggan dan aksi yang bisa admin lakukan.</p>
        </div>
        <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Tabel Order
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-full text-emerald-600 dark:text-emerald-400 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-emerald-700 dark:text-emerald-300 font-medium text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-rose-100 dark:bg-rose-500/20 rounded-full text-rose-600 dark:text-rose-400 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <div>
                <p class="text-rose-700 dark:text-rose-300 font-medium text-sm mt-0.5">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Left details col -->
        <div class="md:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none p-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    Informasi Transaksi
                </h2>
                
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">User Pelanggan</p>
                        <p class="font-medium text-slate-900 dark:text-white">{{ optional($order->user)->name ?? 'Guest/Unknown' }}</p>
                        <p class="text-sm text-slate-500">{{ optional($order->user)->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Tanggal Pesan</p>
                        <p class="font-medium text-slate-900 dark:text-white">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Status Web</p>
                        @if($order->package_id)
                            <div class="flex items-center gap-3 mt-2">
                                @if(optional($order->package)->image_path)
                                    <img src="{{ asset('storage/'. $order->package->image_path) }}" alt="" class="w-12 h-12 rounded-lg object-cover">
                                @endif
                                <span class="font-medium text-slate-900 dark:text-white">{{ optional($order->package)->name }}</span>
                            </div>
                        @else
                            <div class="inline-flex mt-1 items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white font-medium">
                                <svg class="w-4 h-4 text-fuchsia-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                Custom Order Website
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Status Pembayaran</p>
                        <div class="mt-2">
                            @if($order->status === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Lunas</span>
                            @elseif($order->status === 'pending_review')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Menunggu Review Admin</span>
                            @elseif($order->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Menunggu User Membayar</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20"><span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>{{ ucfirst($order->status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($order->custom_details)
                    <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800/50">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Detail Permintaan Website (Klien)</h3>
                        <div class="bg-indigo-50 dark:bg-indigo-500/10 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-500/20">
                            <div class="grid sm:grid-cols-2 gap-6 mb-4">
                                <div><span class="block text-xs uppercase text-indigo-500 dark:text-indigo-400 font-bold mb-1">Nama Proyek</span><span class="font-medium text-slate-900 dark:text-white">{{ $order->custom_details['project_name'] ?? '-' }}</span></div>
                                <div><span class="block text-xs uppercase text-indigo-500 dark:text-indigo-400 font-bold mb-1">Kategori / Tipe</span><span class="font-medium text-slate-900 dark:text-white">{{ $order->custom_details['category'] ?? '-' }}</span></div>
                                <div><span class="block text-xs uppercase text-indigo-500 dark:text-indigo-400 font-bold mb-1">Budget Maksimal</span><span class="font-medium text-amber-600 dark:text-amber-400">{{ $order->custom_details['budget'] ?? 'Tidak diisi' }}</span></div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-indigo-200/50 dark:border-indigo-500/20">
                                <span class="block text-xs uppercase text-indigo-500 dark:text-indigo-400 font-bold mb-2">Deskripsi Requirement</span>
                                <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line">{{ $order->custom_details['description'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Total Harga/Tagihan</p>
                        <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400">
                            @if($order->price > 0)
                                Rp {{ number_format($order->price, 0, ',', '.') }}
                            @else
                                <span class="text-slate-400 text-xl italic drop-shadow-none bg-none font-normal">Belum Ditetapkan</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Notes or Midtrans info -->
            @if($order->payment)
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 md:p-8">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Informasi Tagihan Midtrans</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm text-slate-600 dark:text-slate-400">
                        <div>Transaction ID</div><div class="font-medium text-slate-900 dark:text-white text-right">{{ $order->payment->transaction_id ?? '-' }}</div>
                        <div>Payment Type</div><div class="font-medium text-slate-900 dark:text-white text-right">{{ $order->payment->payment_type ?? '-' }}</div>
                        <div>Gross Amount</div><div class="font-medium text-slate-900 dark:text-white text-right">Rp {{ number_format($order->payment->gross_amount ?? 0) }}</div>
                        <div>Response Status</div><div class="font-medium text-slate-900 dark:text-white text-right">{{ $order->payment->status_code ?? '-' }}</div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right action col (Admin Action) -->
        <div class="md:col-span-1 space-y-6">
            @if($order->status === 'pending_review' && !$order->package_id)
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border-2 border-fuchsia-500/30 shadow-2xl shadow-fuchsia-500/10 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-fuchsia-500/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-fuchsia-100 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 rounded-lg">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white">Proses Custom Order</h3>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                            Pesanan Custom Website ini membutuhkan penawaran harga dari Admin. Diskusikan dengan pelanggan di luar app, lalu masukkan harga deal di sini.
                        </p>

                        <form action="{{ route('admin.orders.update_price', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Angka Harga Deal (Rp)</label>
                                <input type="number" name="price" required min="1" placeholder="Misal: 3500000" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-fuchsia-500 focus:border-fuchsia-500">
                                @error('price')
                                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                                <button type="submit" class="w-full py-3 px-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold text-sm rounded-xl hover:opacity-90 transition-opacity">
                                    Simpan & Tagih Klien
                                </button>
                            </form>

                            <div class="mt-6 pt-6 border-t border-fuchsia-500/20">
                                <form action="{{ route('admin.orders.reject_form', $order->id) }}" method="POST" onsubmit="return confirm('Tolak dan batalkan form pesanan Kustom ini?');">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold text-rose-500 dark:text-rose-400 uppercase mb-2">Tolak Order Ini (Sertakan Alasan)</label>
                                        <textarea name="reject_reason" required rows="2" placeholder="Cth: Maaf, kapasitas tim kami penuh..." class="w-full rounded-xl border-rose-300 dark:border-rose-700/50 bg-rose-50 dark:bg-rose-900/10 text-slate-900 dark:text-white focus:ring-rose-500 focus:border-rose-500 text-sm"></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-3 px-4 bg-rose-100 hover:bg-rose-200 text-rose-700 dark:bg-rose-500/20 dark:hover:bg-rose-500/30 dark:text-rose-400 font-bold text-sm rounded-xl transition-colors border border-rose-200 dark:border-rose-700/50">
                                        Kembalikan / Tolak Penawaran
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
            @else
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center mx-auto mb-3 text-slate-400">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white">Aksi Terkunci</h3>
                    <p class="text-sm text-slate-500 mt-2">Pesanan ini sudah bukan lagi dalam fase peninjauan ("pending_review") atau merupakan pesanan Reguler. Tidak ada aksi khusus yang diperlukan Admin terkait harga.</p>
                </div>
            @endif

            @if($order->status === 'pending_verification')
                <div class="bg-blue-50 dark:bg-blue-500/10 rounded-[2.5rem] border border-blue-200 dark:border-blue-500/20 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="font-bold text-blue-900 dark:text-blue-300">Verifikasi Pembayaran</h3>
                    </div>
                    <p class="text-sm text-blue-700 dark:text-blue-400 mb-6 leading-relaxed">
                        Pelanggan telah mengunggah bukti transfer. Silakan periksa mutasi rekening sebelum menyetujui.
                    </p>
                    
                    @if(optional($order->payment)->proof_image)
                        <div class="mb-6 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800">
                            <a href="{{ asset('storage/' . $order->payment->proof_image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $order->payment->proof_image) }}" alt="Bukti Pembayaran" class="w-full object-contain max-h-64 mt-2">
                            </a>
                            <p class="text-xs text-center text-slate-500 py-2">Klik gambar untuk melihat penuh</p>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <form action="{{ route('admin.orders.verify_payment', $order->id) }}" method="POST" onsubmit="return confirm('Tandai pesanan ini lunas?');">
                            @csrf
                            <button type="submit" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl transition-colors shadow-lg shadow-emerald-600/30 border border-emerald-700/50">
                                Terima & Tandai Lunas
                            </button>
                        </form>

                        <form action="{{ route('admin.orders.reject_payment', $order->id) }}" method="POST" onsubmit="return confirm('Tolak bukti pembayaran ini? Status pesanan akan dikembalikan menjadi Pending.');">
                            @csrf
                            <button type="submit" class="w-full py-3 px-4 bg-white dark:bg-slate-800 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800 font-bold text-sm rounded-xl hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors">
                                Tolak Bukti
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Cancel Button Area -->
            @if($order->status !== 'paid' && $order->status !== 'cancelled' && $order->status !== 'failed')
                <div class="bg-rose-50 dark:bg-rose-500/10 rounded-[2.5rem] border border-rose-200 dark:border-rose-500/20 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 rounded-lg">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <h3 class="font-bold text-rose-900 dark:text-rose-300">Batalkan Pesanan</h3>
                    </div>
                    <p class="text-sm text-rose-700 dark:text-rose-400 mb-6 leading-relaxed">
                        Pesanan yang belum lunas dapat Anda batalkan secara manual jika pelanggan tidak merespon atau permintaan dibatalkan.
                    </p>
                    <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan pesanan ini secara manual?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full py-3 px-4 bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm rounded-xl transition-colors shadow-lg shadow-rose-600/30 border border-rose-700/50">
                            Batalkan Order Ini
                        </button>
                    </form>
                </div>
            @endif
        </div>
        
    </div>
</div>

@endsection
