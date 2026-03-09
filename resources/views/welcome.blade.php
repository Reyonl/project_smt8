<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Jasa Website') }} - Solusi Web Profesional</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- CDN Tailwind (Fallback) -->
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .glass-nav {
                background: rgba(15, 23, 42, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            .glass-card {
                background: rgba(30, 41, 59, 0.5);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
            .text-gradient {
                background-clip: text;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-image: linear-gradient(90deg, #A855F7, #3B82F6, #EC4899);
            }
            .hero-bg {
                background-image: url('{{ asset('storage/hero-bg.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            .hero-overlay {
                background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 1) 100%);
            }
            
            /* Custom animations */
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            .animate-float-delayed {
                animation: float 6s ease-in-out 3s infinite;
            }
        </style>
    </head>
    <body class="bg-slate-900 text-slate-100 antialiased selection:bg-fuchsia-500 selection:text-white">

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 glass-nav transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.scrollTo(0,0)">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center">
                            <span class="font-bold text-white text-lg">JW</span>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-white">{{ config('app.name', 'Jasa Websites') }}</span>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#layanan" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Layanan</a>
                        <a href="#keunggulan" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Keunggulan</a>
                        <a href="#testimoni" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Klien</a>
                        
                        <div class="flex items-center gap-4 border-l border-slate-700 pl-8 ml-2">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-white hover:text-fuchsia-400 transition-colors">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Masuk</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-sm font-semibold bg-white text-slate-900 px-5 py-2.5 rounded-full hover:bg-slate-200 transition-colors shadow-[0_0_15px_rgba(255,255,255,0.3)]">Daftar</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button class="text-slate-300 hover:text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center hero-bg">
            <div class="absolute inset-0 hero-overlay"></div>
            
            <!-- Graphic Elements -->
            <div class="absolute top-1/4 left-10 w-72 h-72 bg-fuchsia-600/20 rounded-full blur-[100px] -z-0"></div>
            <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px] -z-0"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700 mb-6">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-fuchsia-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-fuchsia-500"></span>
                            </span>
                            <span class="text-xs font-medium text-slate-300 uppercase tracking-wider">Agensi Web Profesional</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-[1.1]">
                            Tingkatkan <br />
                            Bisnis Anda dengan <br />
                            <span class="text-gradient">Website Premium</span>
                        </h1>
                        
                        <p class="text-lg text-slate-400 mb-10 max-w-xl leading-relaxed">
                            Kami membangun website modern, cepat, dan berorientasi pada konversi. Solusi digital tepat guna untuk memenangkan kompetisi di era cerdas.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#layanan" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-sm font-semibold rounded-full bg-white text-slate-900 hover:bg-slate-100 hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                                Mulai Projek Baru
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="{{ route('packages') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-sm font-medium rounded-full glass-card text-white hover:bg-slate-800 transition-all duration-300">
                                Lihat Paket Pre-built
                            </a>
                        </div>
                        
                        <div class="mt-12 flex items-center gap-6">
                            <div class="flex -space-x-3">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-900 object-cover" src="https://i.pravatar.cc/100?img=1" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-900 object-cover" src="https://i.pravatar.cc/100?img=2" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-slate-900 object-cover" src="https://i.pravatar.cc/100?img=3" alt="User">
                                <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-800 flex items-center justify-center text-xs font-semibold text-white">+50</div>
                            </div>
                            <div class="text-sm text-slate-400">
                                Dipercaya oleh <span class="font-semibold text-white">50+ Klien</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hidden lg:block relative h-[600px] w-full">
                        <!-- Abstract UI Cards (Floating) -->
                        <div class="absolute top-10 right-10 glass-card p-4 rounded-2xl w-64 animate-float shadow-2xl z-20">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400">Traffic Growth</div>
                                    <div class="font-bold text-white">+245%</div>
                                </div>
                            </div>
                            <div class="w-full h-16 bg-slate-800 rounded-lg flex items-end p-2 gap-1 overflow-hidden">
                                <div class="w-full bg-blue-500 rounded-sm" style="height: 40%"></div>
                                <div class="w-full bg-blue-500 rounded-sm" style="height: 60%"></div>
                                <div class="w-full bg-blue-500 rounded-sm" style="height: 45%"></div>
                                <div class="w-full bg-blue-500 rounded-sm" style="height: 80%"></div>
                                <div class="w-full bg-fuchsia-500 rounded-sm" style="height: 100%"></div>
                            </div>
                        </div>

                        <div class="absolute bottom-20 left-10 glass-card p-5 rounded-3xl w-72 animate-float-delayed shadow-2xl z-10 border-t border-l border-white/10">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 p-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="px-2 py-1 rounded bg-emerald-500/20 text-emerald-400 text-xs font-medium">Selesai</span>
                            </div>
                            <div class="font-semibold text-lg text-white mb-1">E-Commerce App</div>
                            <div class="text-sm text-slate-400 mb-4">Peluncuran Tepat Waktu</div>
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-slate-700 border border-slate-600"></div>
                                <div class="w-8 h-8 rounded-full bg-slate-600 border border-slate-500"></div>
                                <div class="w-8 h-8 rounded-full bg-slate-500 border border-slate-400"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section class="py-24 relative bg-slate-900" id="keunggulan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl mb-4">Teknologi Modern untuk Keunggulan Maksimal</h2>
                    <p class="text-lg text-slate-400">Kami tidak hanya membuat website yang indah, tetapi juga sangat cepat, aman, dan mudah ditemukan oleh mesin pencari.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass-card p-8 rounded-3xl hover:bg-slate-800/80 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Tenggat Waktu Super Cepat</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Arsitektur web dioptimalkan untuk performa tertinggi. Loading instan meningkatkan retensi pelanggan Anda.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass-card p-8 rounded-3xl hover:bg-slate-800/80 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-fuchsia-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-fuchsia-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Keamanan Terjamin</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Perlindungan berlapis melawan ancaman cyber. Data pelanggan Anda aman bersama teknologi pertahanan kami.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass-card p-8 rounded-3xl hover:bg-slate-800/80 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">SEO Teroptimasi</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">Struktur kode ramah mesin pencari sejak hari pertama. Peringkat lebih tinggi di Google secara alami.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services CTA / Link to Custom/Packages -->
        <section class="py-24 relative" id="layanan">
            <div class="absolute inset-0 bg-slate-900 border-t border-slate-800 pt-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="glass-card rounded-[3rem] p-8 md:p-16 border-t border-l border-white/5 relative overflow-hidden">
                    <!-- Glow effect -->
                    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] -z-10 translate-x-1/2 -translate-y-1/2"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-white mb-6">Wujudkan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Visi Unik</span> Anda</h2>
                            <p class="text-lg text-slate-400 mb-8 leading-relaxed">Tidak menemukan paket yang sesuai? Kami dapat membangun solusi kustom sepenuhnya yang dirancang eksklusif untuk kebutuhan spesifik bisnis Anda.</p>
                            
                            <ul class="space-y-4 mb-10">
                                <li class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-slate-300">Desain UI/UX Eksklusif (Figma)</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-slate-300">Integrasi API Kompleks</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-slate-300">Sistem MVP & Web App</span>
                                </li>
                            </ul>
                            
                            <a href="{{ route('custom.order') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 text-sm font-semibold rounded-full bg-gradient-to-r from-blue-600 to-emerald-500 text-white hover:opacity-90 transition-all shadow-lg hover:shadow-blue-500/25">
                                Konsultasi Custom Web
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        
                        <div class="relative">
                            <div class="glass-card rounded-2xl p-6 border border-slate-700">
                                <h3 class="text-xl font-semibold mb-4 text-white">Atau mulai dengan Paket Praktis</h3>
                                <p class="text-sm text-slate-400 mb-6">Pilih template premium kami untuk peluncuran lebih cepat dengan harga terjangkau.</p>
                                
                                <a href="{{ route('packages') }}" class="w-full block text-center px-6 py-3 rounded-xl bg-slate-800 text-white hover:bg-slate-700 border border-slate-600 transition-colors font-medium">
                                    Lihat Semua Paket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-950 border-t border-slate-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center">
                            <span class="font-bold text-white text-sm">JW</span>
                        </div>
                        <span class="font-bold text-lg text-white">{{ config('app.name', 'Jasa Websites') }}</span>
                    </div>
                    
                    <p class="text-slate-500 text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Jasa Websites') }}. All rights reserved. Built with passion and code.
                    </p>
                    
                    <div class="flex gap-4">
                        <a href="#" class="text-slate-500 hover:text-white transition-colors">Twitter</a>
                        <a href="#" class="text-slate-500 hover:text-white transition-colors">Dribbble</a>
                        <a href="#" class="text-slate-500 hover:text-white transition-colors">GitHub</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Transparent Navbar Script -->
        <script>
            window.addEventListener('scroll', () => {
                const nav = document.querySelector('nav');
                if (window.scrollY > 10) {
                    nav.classList.add('glass-nav');
                    nav.classList.remove('bg-transparent', 'border-transparent');
                } else {
                    nav.classList.remove('glass-nav');
                    nav.classList.add('bg-transparent', 'border-transparent');
                }
            });
        </script>
    </body>
</html>
