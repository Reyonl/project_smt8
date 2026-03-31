<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>

    <body class="min-h-full">
        <div
            x-data="{
                open: false,
                isDark: false,
                init() {
                    const saved = localStorage.getItem('theme');
                    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    this.isDark = (saved === 'dark') || (!saved && prefersDark);
                    document.documentElement.classList.toggle('dark', this.isDark);
                },
                toggleTheme() {
                    this.isDark = !this.isDark;
                    document.documentElement.classList.toggle('dark', this.isDark);
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                }
            }"
            class="min-h-screen"
        >
            <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-slate-900 focus:shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:bg-slate-950 dark:focus:text-slate-50">
                Skip to content
            </a>

            <!-- HEADER: layouts.app -->
            <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/70">
                <div class="container-app">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold tracking-tight text-slate-900 dark:text-slate-50">
                                <span class="grid h-9 w-9 place-items-center rounded-xl bg-indigo-600 text-white shadow-sm">
                                    <span class="text-sm">JW</span>
                                </span>
                                <span class="hidden sm:block">{{ config('app.name') }}</span>
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

                            @auth
                                <!-- Notifications -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="relative rounded-xl p-2 text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900 focus:outline-none">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        @if(auth()->user()->unreadNotifications->count() > 0)
                                            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-950"></span>
                                        @endif
                                    </button>

                                    <!-- Notifications Dropdown -->
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-80 origin-top-right rounded-2xl border border-slate-200 bg-white py-2 shadow-xl dark:border-slate-800 dark:bg-slate-950">
                                        <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
                                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Notifikasi</h3>
                                        </div>
                                        <div class="max-h-64 overflow-y-auto">
                                            @forelse(auth()->user()->unreadNotifications as $notification)
                                                <a href="{{ $notification->data['url'] ?? '#' }}" class="block px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-900 border-b border-slate-50 dark:border-slate-900 last:border-0">
                                                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $notification->data['message'] }}</p>
                                                    <p class="mt-1 text-xs text-slate-500">{{ $notification->created_at->diffForHumans() }}</p>
                                                </a>
                                            @empty
                                                <div class="px-4 py-8 text-center">
                                                    <p class="text-sm text-slate-500 italic">Tidak ada notifikasi baru</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        @if(auth()->user()->unreadNotifications->count() > 0)
                                            <div class="px-4 py-2 text-center border-t border-slate-100 dark:border-slate-800">
                                                <form action="{{ route('notifications.read') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs font-bold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">Tandai sudah dibaca</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endauth

                            <button type="button" class="btn btn-outline px-3" @click="toggleTheme()" :aria-label="isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'" :title="isDark ? 'Mode gelap: ON' : 'Mode terang: ON'">
                                <!-- Sun -->
                                <svg x-show="isDark" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" />
                                    <path d="M12 2v2" />
                                    <path d="M12 20v2" />
                                    <path d="m4.93 4.93 1.41 1.41" />
                                    <path d="m17.66 17.66 1.41 1.41" />
                                    <path d="M2 12h2" />
                                    <path d="M20 12h2" />
                                    <path d="m6.34 17.66-1.41 1.41" />
                                    <path d="m19.07 4.93-1.41 1.41" />
                                </svg>
                                <!-- Moon -->
                                <svg x-show="!isDark" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 3a7 7 0 1 0 9 9 9 9 0 0 1-9-9Z" />
                                </svg>
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

                            <button type="button" class="mt-2 flex items-center gap-2 rounded-xl px-3 py-2 text-left text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-900" @click="toggleTheme()">
                                <span x-text="isDark ? 'Mode terang' : 'Mode gelap'"></span>
                                <span class="ml-auto">
                                    <svg x-show="isDark" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" />
                                        <path d="M12 2v2" />
                                        <path d="M12 20v2" />
                                        <path d="m4.93 4.93 1.41 1.41" />
                                        <path d="m17.66 17.66 1.41 1.41" />
                                        <path d="M2 12h2" />
                                        <path d="M20 12h2" />
                                        <path d="m6.34 17.66-1.41 1.41" />
                                        <path d="m19.07 4.93-1.41 1.41" />
                                    </svg>
                                    <svg x-show="!isDark" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 3a7 7 0 1 0 9 9 9 9 0 0 1-9-9Z" />
                                    </svg>
                                </span>
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

            <!-- FOOTER: layouts.app -->
            <footer class="border-t border-slate-200/70 py-10 dark:border-slate-800/70">
                <div class="container-app">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
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