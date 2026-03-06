@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden rounded-3xl border border-slate-200/70 bg-white p-8 shadow-sm dark:border-slate-800/70 dark:bg-slate-900 sm:p-12">
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-indigo-50 via-white to-white dark:from-indigo-950/30 dark:via-slate-900 dark:to-slate-900"></div>

    <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
        <div class="space-y-6">
            <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-200 dark:ring-indigo-500/20">
                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                Launch lebih cepat, hasil lebih rapi
            </div>

            <h1 class="text-balance text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-50 sm:text-5xl">
                Jasa Pembuatan Website Profesional
            </h1>

            <p class="max-w-xl text-pretty text-base leading-relaxed text-slate-600 dark:text-slate-300 sm:text-lg">
                Buat website bisnis, company profile, atau toko online dengan alur yang jelas: pilih paket → bayar → kami eksekusi.
            </p>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <a href="{{ route('packages') }}" class="btn btn-primary">
                    Lihat Paket
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.06.02Z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#keunggulan" class="btn btn-outline">Lihat Keunggulan</a>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-50">Estimasi cepat</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Brief → eksekusi</p>
                </div>
                <div class="rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-50">Mobile-first</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Nyaman di HP</p>
                </div>
                <div class="hidden rounded-2xl border border-slate-200/70 bg-white/60 p-4 dark:border-slate-800/70 dark:bg-slate-950/30 sm:block">
                    <p class="text-sm font-semibold text-slate-900 dark:text-slate-50">Support</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">After launch</p>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="rounded-3xl border border-slate-200/70 bg-gradient-to-br from-slate-900 to-indigo-900 p-1 shadow-sm dark:border-slate-800/70">
                <div class="rounded-[1.35rem] bg-white p-6 dark:bg-slate-950">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="h-2.5 w-2.5 rounded-full bg-rose-400"></div>
                            <div class="h-2.5 w-2.5 rounded-full bg-amber-400"></div>
                            <div class="h-2.5 w-2.5 rounded-full bg-emerald-400"></div>
                        </div>
                        <div class="text-xs font-medium text-slate-500">Preview</div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <div class="h-3 w-2/3 rounded bg-slate-200 dark:bg-slate-800"></div>
                        <div class="h-3 w-5/6 rounded bg-slate-200 dark:bg-slate-800"></div>
                        <div class="h-3 w-1/2 rounded bg-slate-200 dark:bg-slate-800"></div>
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="h-24 rounded-2xl bg-indigo-100 dark:bg-indigo-500/15"></div>
                            <div class="h-24 rounded-2xl bg-slate-100 dark:bg-slate-900"></div>
                        </div>
                        <div class="h-10 rounded-2xl bg-slate-100 dark:bg-slate-900"></div>
                    </div>
                </div>
            </div>
            <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-indigo-400/20 blur-3xl dark:bg-indigo-500/20"></div>
        </div>
    </div>
</section>

<section id="keunggulan" class="mt-12 grid gap-6 lg:grid-cols-3">
    <div class="card">
        <div class="card-body">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-50">Flow order jelas</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                User langsung paham langkahnya: pilih paket → checkout → pembayaran → status pesanan.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-50">Tampilan modern</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                Typography rapi, spacing enak, tombol & form konsisten di semua halaman.
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-50">Responsif & aksesibel</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                Kontras, fokus keyboard, dan komponen yang nyaman dipakai di mobile.
            </p>
        </div>
    </div>
</section>

@endsection


