@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Detail Pesanan</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Ringkasan pesanan dan aksi yang tersedia.</p>
        </div>
        <a href="{{ route('my.orders') }}" class="btn btn-outline">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(optional($order->package)->image_path)
                <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200/70 bg-slate-100 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <img
                        src="{{ asset('storage/' . $order->package->image_path) }}"
                        alt="Preview {{ $order->package->name }}"
                        class="aspect-video w-full object-cover"
                        loading="lazy"
                    />
                </div>
            @endif

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Order Code</p>
                    <p class="mt-1 font-semibold text-slate-900 dark:text-slate-50">{{ $order->order_code }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Paket</p>
                    <p class="mt-1 font-semibold text-slate-900 dark:text-slate-50">{{ optional($order->package)->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Total</p>
                    <p class="mt-1 text-lg font-semibold text-indigo-600 dark:text-indigo-300">Rp {{ number_format($order->price) }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Status</p>
                    <div class="mt-1">
                        @if($order->isPaid())
                            <span class="badge badge-success">Lunas</span>
                        @elseif($order->status === 'pending')
                            <span class="badge badge-warning">Menunggu</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($order->status) }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Transaction ID</p>
                    <p class="mt-1 font-medium text-slate-900 dark:text-slate-50">{{ optional($order->payment)->transaction_id ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Tanggal</p>
                    <p class="mt-1 font-medium text-slate-900 dark:text-slate-50">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            @if($order->status === 'pending')
                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900 dark:border-amber-500/30 dark:bg-amber-500/10 dark:text-amber-200">
                        Pembayaran masih <span class="font-semibold">pending</span>. Kamu bisa coba ulang pembayaran.
                    </div>
                    <a href="{{ route('checkout.retry', $order->id) }}" class="btn btn-primary">Retry Payment</a>
                </div>
            @endif
        </div>
    </div>


    <!-- Project Timeline for User -->
    @if(in_array($order->status, ['paid', 'processing', 'revision', 'completed']))
        <div class="card mt-2">
            <div class="card-body">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <span class="p-2 bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                    </span>
                    Ruang Diskusi & Progress Proyek
                </h2>

                <!-- List Updates -->
                <div class="space-y-6 mb-8">
                    @forelse($order->updates as $update)
                        <div class="flex gap-4 {{ $update->is_admin_update ? 'flex-row-reverse' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $update->is_admin_update ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-600' }}">
                                    {{ substr($update->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="{{ $update->is_admin_update ? 'bg-indigo-50 dark:bg-indigo-500/10 border-indigo-100 dark:border-indigo-500/20' : 'bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700' }} border rounded-2xl p-4 max-w-xl w-full">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-sm {{ $update->is_admin_update ? 'text-indigo-900 dark:text-indigo-300' : 'text-slate-900 dark:text-white' }}">{{ $update->is_admin_update ? 'Admin Jasa Websites' : 'Anda' }}</span>
                                    <span class="text-xs text-slate-500">{{ $update->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                @if($update->message)
                                    <p class="text-sm text-slate-700 dark:text-slate-300 whitespace-pre-line">{{ $update->message }}</p>
                                @endif
                                @if($update->attachment_path)
                                    <div class="mt-3">
                                        <a href="{{ asset('storage/' . $update->attachment_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $update->attachment_path) }}" class="rounded-xl max-h-48 object-cover border border-slate-200 dark:border-slate-700" alt="Attachment">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-500">
                            Belum ada pesan. Admin akan mengupdate progress di sini.
                        </div>
                    @endforelse
                </div>

                <!-- Form Balasan User -->
                @if($order->status !== 'completed')
                    <form action="{{ route('order.reply', $order->id) }}" method="POST" enctype="multipart/form-data" class="border-t border-slate-200 dark:border-slate-800 pt-6" onsubmit="trackOrderReply('{{ $order->id }}')">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Pesan ke Admin</label>
                            <textarea name="message" rows="3" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ketik pesan atau lampirkan materi..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Lampiran (Opsional)</label>
                            <input type="file" name="attachment" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Kirim Pesan
                        </button>
                    </form>
                @else
                    <div class="text-center py-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-xl mt-6 border border-emerald-200 dark:border-emerald-500/20">
                        Proyek ini telah ditandai Selesai. Terima kasih telah menggunakan jasa kami!
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function trackOrderReply(orderId) {
    if (typeof gtag === 'function') {
        gtag('event', 'order_reply_submit', {
            order_id: orderId
        });
    }
}
</script>
@endpush
