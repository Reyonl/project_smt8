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
                        @if($order->status === 'paid')
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
</div>

@endsection


