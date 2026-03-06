<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-50">
            <div class="mx-auto flex min-h-screen w-full max-w-6xl items-center px-4 py-10 sm:px-6 lg:px-8">
                <div class="grid w-full gap-8 lg:grid-cols-2 lg:items-center">
                    <div class="hidden lg:block">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-indigo-600 text-white shadow-sm">
                                <span class="text-sm font-semibold">JW</span>
                            </span>
                            <span class="text-lg font-semibold tracking-tight">{{ config('app.name') }}</span>
                        </a>

                        <h1 class="mt-8 text-3xl font-semibold tracking-tight">
                            Mulai order website dengan flow yang jelas.
                        </h1>
                        <p class="mt-3 max-w-md text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                            Buat akun untuk memantau status pesanan, retry pembayaran bila pending, dan melihat riwayat order.
                        </p>

                        <div class="mt-8 grid gap-4">
                            <div class="rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm dark:border-slate-800/70 dark:bg-slate-900">
                                <p class="text-sm font-semibold">Transparan</p>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Status pesanan jelas: pending / paid.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm dark:border-slate-800/70 dark:bg-slate-900">
                                <p class="text-sm font-semibold">Cepat</p>
                                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Pilih paket → checkout → bayar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto w-full max-w-md">
                        <div class="mb-6 flex items-center justify-between">
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-semibold tracking-tight">
                                <span class="grid h-10 w-10 place-items-center rounded-2xl bg-indigo-600 text-white shadow-sm">
                                    <span class="text-sm font-semibold">JW</span>
                                </span>
                                <span>{{ config('app.name') }}</span>
                            </a>
                            <a href="{{ route('packages') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-200">
                                Lihat Paket
                            </a>
                        </div>

                        <div class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-sm dark:border-slate-800/70 dark:bg-slate-900">
                            {{ $slot }}
                        </div>

                        <p class="mt-4 text-xs text-slate-500 dark:text-slate-400">
                            Dengan mendaftar, kamu setuju untuk menggunakan layanan ini secara wajar & sesuai aturan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
