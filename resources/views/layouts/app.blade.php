<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jasa Website') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>

    <body class="min-h-full">
        <div x-data="{ open: false }" class="min-h-screen">
            <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-slate-900 focus:shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:bg-slate-950 dark:focus:text-slate-50">
                Skip to content
            </a>

            <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/70">
                <div class="container-app">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold tracking-tight text-slate-900 dark:text-slate-50">
                                <span class="grid h-9 w-9 place-items-center rounded-xl bg-indigo-600 text-white shadow-sm">
                                    <span class="text-sm">JW</span>
                                </span>
                                <span class="hidden sm:block">{{ config('app.name', 'Jasa Website') }}</span>
                            </a>

                            <nav class="hidden items-center gap-1 md:flex">
                                <a href="{{ route('home') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">
                                    Beranda
                                </a>
                                <a href="{{ route('packages') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">
                                    Paket
                                </a>
                            </nav>
                        </div>

                        <div class="hidden items-center gap-2 md:flex">
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Admin</a>
                                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Kelola Paket</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
                                    <a href="{{ route('my.orders') }}" class="btn btn-outline">Pesanan</a>
                                @endif

                                <div class="h-6 w-px bg-slate-200 dark:bg-slate-800"></div>

                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Logout</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endauth

                            <button
                                type="button"
                                class="btn btn-outline"
                                x-data="{}"
                                x-on:click="
                                    document.documentElement.classList.toggle('dark');
                                    localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                                "
                                x-init="
                                    const saved = localStorage.getItem('theme');
                                    if (saved === 'dark') document.documentElement.classList.add('dark');
                                "
                            >
                                Tema
                            </button>
                        </div>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl p-2 text-slate-700 hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:text-slate-200 dark:hover:bg-slate-900 dark:focus-visible:ring-offset-slate-950 md:hidden"
                            @click="open = !open"
                            aria-label="Toggle menu"
                        >
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path x-show="!open" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path x-show="open" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div x-show="open" x-cloak class="pb-4 md:hidden">
                        <nav class="grid gap-1">
                            <a href="{{ route('home') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Beranda</a>
                            <a href="{{ route('packages') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Paket</a>

                            <div class="my-2 h-px bg-slate-200 dark:bg-slate-800"></div>

                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Admin</a>
                                    <a href="{{ route('admin.packages.index') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Kelola Paket</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Dashboard</a>
                                    <a href="{{ route('my.orders') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Pesanan</a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}" class="px-3 pt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary w-full">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Login</a>
                                <a href="{{ route('register') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900">Register</a>
                            @endauth

                            <button
                                type="button"
                                class="mt-2 rounded-xl px-3 py-2 text-left text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900"
                                x-on:click="
                                    document.documentElement.classList.toggle('dark');
                                    localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                                "
                                x-init="
                                    const saved = localStorage.getItem('theme');
                                    if (saved === 'dark') document.documentElement.classList.add('dark');
                                "
                            >
                                Toggle Tema
                            </button>
                        </nav>
                    </div>
                </div>
            </header>

            <main id="main-content" class="py-10">
                <div class="container-app">
                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-slate-200/70 py-10 dark:border-slate-800/70">
                <div class="container-app">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            © {{ date('Y') }} {{ config('app.name', 'Jasa Website') }}. All rights reserved.
                        </p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Dibuat untuk flow order yang cepat, jelas, dan aman.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>