@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Pesanan Saya</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Riwayat pesanan dan status pembayaran.</p>
        </div>
        <a href="{{ route('packages') }}" class="btn btn-primary">Order Baru</a>
    </div>

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="card">
            <div class="card-body">
                <p class="text-base font-semibold text-slate-900 dark:text-slate-50">Belum ada pesanan</p>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Mulai dari memilih paket yang sesuai kebutuhanmu.</p>
                <div class="mt-4">
                    <a href="{{ route('packages') }}" class="btn btn-primary">Lihat Paket</a>
                </div>
            </div>
        </div>
    @else
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Paket</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Transaksi ID</th>
                            <th>Tanggal</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                            <tr>
                                <td class="font-medium text-slate-900 dark:text-slate-50">{{ $o->order_code }}</td>
                                <td class="text-slate-700 dark:text-slate-200">{{ optional($o->package)->name }}</td>
                                <td class="text-slate-700 dark:text-slate-200">Rp {{ number_format($o->price) }}</td>
                                <td>
                                    @if($o->status === 'paid')
                                        <span class="badge badge-success">Lunas</span>
                                    @elseif($o->status === 'pending')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($o->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-slate-700 dark:text-slate-200">{{ optional($o->payment)->transaction_id ?? '-' }}</td>
                                <td class="text-slate-700 dark:text-slate-200">{{ $o->created_at->format('Y-m-d H:i') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('order.show', $o->id) }}" class="btn btn-outline">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@endsection


