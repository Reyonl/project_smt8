@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Orders</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Daftar order terbaru beserta status pembayaran.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Kembali</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>User</th>
                        <th>Paket</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td class="font-medium text-slate-900 dark:text-slate-50">{{ $o->order_code }}</td>
                            <td class="text-slate-700 dark:text-slate-200">{{ optional($o->user)->name ?? $o->user_id }}</td>
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
                            <td class="text-slate-700 dark:text-slate-200">{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-600 dark:text-slate-300">Belum ada order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


