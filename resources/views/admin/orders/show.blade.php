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

                <!-- Bagian Notes Awal Checkout -->
                @if($order->notes_awal)
                    <div class="mt-6 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Ide / Catatan Awal Klien
                        </p>
                        <p class="text-sm text-slate-700 dark:text-slate-300 italic whitespace-pre-wrap">"{{ $order->notes_awal }}"</p>
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

            <!-- Briefing Client -->
            @if($order->brief)
                <div class="bg-indigo-50/50 dark:bg-indigo-900/10 rounded-3xl border border-indigo-200 dark:border-indigo-800/50 p-6 md:p-8 mt-8">
                    <h3 class="text-lg font-bold text-indigo-900 dark:text-indigo-300 flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Data Brief Project Client
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-semibold text-indigo-500 uppercase tracking-widest mb-1">Nama Perusahaan / Bisnis</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $order->brief->company_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-indigo-500 uppercase tracking-widest mb-1">Kategori Usaha</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $order->brief->business_type }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-indigo-500 uppercase tracking-widest mb-1">Preferensi Warna</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $order->brief->favorite_colors ?? '-' }}</p>
                        </div>
                        <div class="p-4 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Referensi Desain</p>
                            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $order->brief->design_preferences ?? '-' }}</p>
                        </div>
                        <div class="p-4 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2">Catatan Tambahan / Fitur</p>
                            <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $order->brief->additional_notes ?? '-' }}</p>
                        </div>
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
                    </div>
                </div>
            @elseif($order->status === 'paid')
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-blue-200 dark:border-blue-900 shadow-xl shadow-blue-500/10 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white">Kelola Progress Proyek</h3>
                        </div>
                        
                        @if(!$order->brief)
                            <div class="bg-amber-50 dark:bg-amber-500/10 text-amber-800 dark:text-amber-400 p-4 rounded-2xl text-sm border border-amber-200 dark:border-amber-500/20 mb-4">
                                Pelanggan belum mengisi Brief Project. Progress baru bisa di-update jika brief sudah masuk.
                            </div>
                        @else
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                                Pesanan ini sedang dikerjakan. Silakan update secara berkala Tahapan Project agar Pelanggan bisa mengetahuinya.
                            </p>
                            <form action="{{ route('admin.orders.update_stage', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-2">Stage Proyek Saat Ini</label>
                                    <select name="project_stage" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 py-3">
                                        @php
                                            $stages = ['Menganalisa Brief', 'Proses Desain & Prototype', 'Proses Development', 'Review & Revisi', 'Finalisasi', 'Selesai'];
                                            $current = $order->project_stage ?? 'Menganalisa Brief';
                                        @endphp
                                        @foreach($stages as $stg)
                                            <option value="{{ $stg }}" {{ $current == $stg ? 'selected' : '' }}>{{ $stg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-bold text-sm rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/30">
                                    Update Stage
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center mx-auto mb-3 text-slate-400">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white">Aksi Terkunci</h3>
                    <p class="text-sm text-slate-500 mt-2">Pesanan ini sudah bukan lagi dalam fase peninjauan ("pending_review") atau belum Lunas. Tidak ada aksi khusus yang diperlukan Admin.</p>
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

            <!-- Project Discussions -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden flex flex-col h-[500px] mt-8">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <div class="p-2 bg-blue-50 dark:bg-blue-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        Diskusi dengan Pelanggan
                    </h3>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6" id="discussion-container">
                    @forelse($order->discussions as $msg)
                        <div @class([
                            'flex flex-col max-w-[85%]',
                            'ml-auto items-end' => $msg->user_id === auth()->id(),
                            'mr-auto items-start' => $msg->user_id !== auth()->id(),
                        ])>
                            <div class="flex items-center gap-2 mb-1 px-2">
                                <span class="text-xs font-bold text-slate-500">{{ $msg->user->name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $msg->created_at->format('d M, H:i') }}</span>
                            </div>
                            <div @class([
                                'px-4 py-3 rounded-2xl text-sm leading-relaxed shadow-sm',
                                'bg-blue-600 text-white rounded-tr-none' => $msg->user_id === auth()->id(),
                                'bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 rounded-tl-none' => $msg->user_id !== auth()->id(),
                            ])>
                                {{ $msg->message }}
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                            <p class="text-sm">Belum ada diskusi dengan pelanggan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="p-6 bg-slate-50 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800">
                    <form action="{{ route('order.discussion.send', $order->id) }}" method="POST" class="relative">
                        @csrf
                        <textarea 
                            name="message" 
                            rows="2" 
                            class="w-full bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 rounded-2xl text-sm focus:ring-blue-500 focus:border-blue-500 p-4 pr-16 transition-all" 
                            placeholder="Tulis instruksi atau balasan..."
                            required
                        ></textarea>
                        <button type="submit" class="absolute right-3 bottom-3 p-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Manage Project Assets (Upload) -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none p-8 mt-8">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/></svg>
                    </div>
                    Manajemen Aset (Deliverables)
                </h3>

                <!-- Upload Form -->
                <form action="{{ route('admin.orders.assets.upload', $order->id) }}" method="POST" enctype="multipart/form-data" class="mb-8 p-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-dashed border-slate-300 dark:border-slate-700">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Pilih File</label>
                            <input type="file" name="file" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Tipe Aset</label>
                            <select name="type" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm">
                                <option value="draft">Review / Draft</option>
                                <option value="final">Final Deliverable</option>
                                <option value="resource">Resource / Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Label Nama File (Opsional)</label>
                        <input type="text" name="file_name" placeholder="Contoh: Desain Landing Page v1" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm">
                    </div>
                    <button type="submit" class="btn btn-primary w-full shadow-lg shadow-indigo-600/20">Unggah Aset Baru</button>
                </form>

                <!-- Asset List -->
                <div class="space-y-4">
                    @forelse($order->assets as $asset)
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $asset->file_name }}</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold">{{ $asset->type }} &bull; {{ $asset->size }} &bull; {{ $asset->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('order.asset.download', $asset->id) }}" class="p-2 text-slate-400 hover:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        </div>
                    @empty
                        <p class="text-center text-sm text-slate-400 py-8">Belum ada aset yang diunggah.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('discussion-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>

@endsection
