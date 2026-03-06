@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50 sm:text-3xl">Paket Pembuatan Website</h1>
        <p class="max-w-2xl text-sm leading-relaxed text-slate-600 dark:text-slate-300">
            Pilih paket yang sesuai kebutuhan. Setelah checkout, kamu langsung diarahkan ke pembayaran dan status pesanan bisa dipantau.
        </p>
    </div>

    @if($packages->isEmpty())
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col gap-2">
                    <p class="text-base font-semibold text-slate-900 dark:text-slate-50">Belum ada paket</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Admin belum menambahkan paket. Coba lagi nanti.</p>
                </div>
            </div>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($packages as $p)
                <div class="group card overflow-hidden">
                    <div class="card-body flex h-full flex-col">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h2 class="truncate text-lg font-semibold text-slate-900 dark:text-slate-50">{{ $p->name }}</h2>
                                <p class="mt-1 line-clamp-3 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ $p->description }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex items-end justify-between gap-4">
                            <div>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Mulai dari</p>
                                <p class="mt-1 text-2xl font-semibold tracking-tight text-indigo-600 dark:text-indigo-300">
                                    Rp {{ number_format($p->price) }}
                                </p>
                            </div>

                            @auth
                                <a href="{{ route('checkout',$p->id) }}" class="btn btn-primary">
                                    Order
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline">
                                    Login untuk order
                                </a>
                            @endauth
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200/70 bg-slate-50 p-4 text-sm text-slate-700 dark:border-slate-800/70 dark:bg-slate-950/30 dark:text-slate-200">
                            <p class="font-medium">Termasuk:</p>
                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-600 dark:text-slate-300">
                                <li>Desain modern & responsif</li>
                                <li>Optimasi performa dasar</li>
                                <li>Support pasca launch</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection


