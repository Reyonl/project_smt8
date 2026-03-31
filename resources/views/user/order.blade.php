@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-8 pb-12">
    <!-- Header Page -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-medium text-slate-500">
                    <li><a href="{{ route('my.orders') }}" class="hover:text-indigo-600 transition-colors">Pesanan Saya</a></li>
                    <li><svg class="w-3 h-3 text-slate-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-slate-900 dark:text-slate-200">Project Hub</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white flex items-center gap-3">
                Project Hub: {{ $order->order_code }}
                @if($order->status === 'paid')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">Active</span>
                @endif
            </h1>
        </div>
        <div class="flex flex-wrap gap-3">
            @if($order->status === 'paid')
                <a href="{{ route('order.invoice', $order->id) }}" class="inline-flex items-center px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all dark:bg-slate-900 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800">
                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Download Invoice
                </a>
            @endif
        </div>
    </div>

    <!-- Main Content & Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Center/Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            
            <!-- Project Progress (Stepper) -->
            @if($order->status === 'paid' && $order->brief)
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none p-8">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    Progress Proyek
                </h3>
                
                @php
                    $stages = [
                        'Menganalisa Brief',
                        'Perencanaan & Struktur',
                        'Desain UI/UX',
                        'Pengembangan Website',
                        'Review & Testing',
                        'Selesai'
                    ];
                    $currentStageIndex = array_search($order->project_stage, $stages);
                    if ($currentStageIndex === false) $currentStageIndex = -1;
                @endphp

                <div class="relative flex flex-col gap-8 md:flex-row md:justify-between md:gap-0">
                    <div class="absolute left-6 top-10 h-full w-0.5 border-l-2 border-dashed border-slate-200 dark:border-slate-800 md:left-0 md:top-6 md:h-0 md:w-full md:border-l-0 md:border-t-2"></div>
                    
                    @foreach($stages as $index => $stage)
                        <div class="relative z-10 flex items-start gap-4 md:flex-col md:items-center md:gap-3 md:text-center">
                            @if($index < $currentStageIndex || $order->project_stage === 'Selesai')
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/20">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            @elseif($index === $currentStageIndex)
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-white shadow-xl shadow-indigo-600/40 ring-4 ring-indigo-100 dark:ring-indigo-900/30">
                                    <svg class="h-6 w-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            @else
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border-2 border-slate-200 bg-white text-slate-400 dark:border-slate-800 dark:bg-slate-900">
                                    <span class="text-sm font-bold">{{ $index + 1 }}</span>
                                </div>
                            @endif
                            <div class="md:px-2">
                                <p @class([
                                    'text-xs font-bold leading-tight uppercase tracking-wider',
                                    'text-emerald-600 dark:text-emerald-400' => $index < $currentStageIndex || $order->project_stage === 'Selesai',
                                    'text-slate-900 dark:text-white' => $index === $currentStageIndex,
                                    'text-slate-400 dark:text-slate-600' => $index > $currentStageIndex && $order->project_stage !== 'Selesai',
                                ])>{{ $stage }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($order->status === 'paid' && !$order->brief)
                <div class="bg-gradient-to-br from-indigo-600 to-fuchsia-700 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-500/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                        <div class="p-5 bg-white/20 backdrop-blur-md rounded-3xl">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black mb-2">Ayo Mulai Proyek Anda!</h2>
                            <p class="text-indigo-100 text-lg mb-6">Agar tim kami bisa segera bekerja, mohon lengkapi brief kebutuhan website Anda terlebih dahulu.</p>
                            <a href="{{ route('order.brief.form', $order->id) }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-700 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-50 transition-all shadow-xl">Isi Brief Sekarang &rarr;</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Discussion Hub -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden flex flex-col h-[600px]">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-3">
                        <div class="p-2 bg-blue-50 dark:bg-blue-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        Diskusi Proyek
                    </h3>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Live Updates</span>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6" id="discussion-container">
                    @forelse($order->discussions as $msg)
                        <div @class([
                            'flex flex-col max-w-[80%]',
                            'ml-auto items-end' => $msg->user_id === auth()->id(),
                            'mr-auto items-start' => $msg->user_id !== auth()->id(),
                        ])>
                            <div class="flex items-center gap-2 mb-1 px-2">
                                <span class="text-xs font-bold text-slate-500">{{ $msg->user->name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                            <div @class([
                                'px-4 py-3 rounded-2xl text-sm leading-relaxed shadow-sm',
                                'bg-indigo-600 text-white rounded-tr-none' => $msg->user_id === auth()->id(),
                                'bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 rounded-tl-none' => $msg->user_id !== auth()->id(),
                            ])>
                                {{ $msg->message }}
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                            <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <p class="font-bold text-slate-900 dark:text-white">Belum ada diskusi</p>
                            <p class="text-sm mt-1">Gunakan area di bawah untuk berkonsultasi.</p>
                        </div>
                    @endforelse
                </div>

                <div class="p-6 bg-slate-50 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800">
                    <form action="{{ route('order.discussion.send', $order->id) }}" method="POST" class="relative">
                        @csrf
                        <textarea 
                            name="message" 
                            rows="2" 
                            class="w-full bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 rounded-2xl text-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 pr-16 transition-all" 
                            placeholder="Tulis pesan atau masukan Anda..."
                            required
                        ></textarea>
                        <button type="submit" class="absolute right-3 bottom-3 p-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar / Right Column -->
        <div class="flex flex-col gap-8">
            
            <!-- Project Deliverables -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none p-8">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    Hasil Kerja (Assets)
                </h3>

                <div class="space-y-4">
                    @forelse($order->assets as $asset)
                        <div class="group p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 hover:border-indigo-200 dark:hover:border-indigo-500/30 transition-all">
                            <div class="flex items-center gap-4">
                                <div @class([
                                    'w-12 h-12 rounded-xl flex items-center justify-center shrink-0',
                                    'bg-blue-100 text-blue-600' => $asset->type === 'draft',
                                    'bg-emerald-100 text-emerald-600' => $asset->type === 'final',
                                    'bg-amber-100 text-amber-600' => $asset->type === 'resource',
                                ])>
                                    @if($asset->type === 'final')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate" title="{{ $asset->file_name }}">{{ $asset->file_name }}</p>
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-500 mt-0.5">{{ $asset->type }} &bull; {{ $asset->size }}</p>
                                </div>
                                <a href="{{ route('order.asset.download', $asset->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 flex flex-col items-center justify-center text-center opacity-40">
                            <svg class="w-12 h-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/></svg>
                            <p class="text-xs font-bold uppercase tracking-widest">Belum ada file</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Project Details Summary -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none p-8">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Ringkasan Project</h3>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Nama Paket</p>
                        <p class="font-bold text-slate-900 dark:text-white">
                            @if($order->package_id)
                                {{ optional($order->package)->name }}
                            @else
                                Custom Order Website
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Total Biaya</p>
                        <p class="text-xl font-black text-indigo-600 dark:text-indigo-400">
                            @if($order->price > 0)
                                Rp {{ number_format($order->price, 0, ',', '.') }}
                            @else
                                <span class="text-sm font-normal italic text-slate-400">Menunggu Penawaran</span>
                            @endif
                        </p>
                    </div>

                    @if($order->brief)
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
                         <p class="text-xs font-bold text-indigo-600 mb-2">Brief Sudah Dikirim</p>
                         <div class="p-4 bg-slate-50 dark:bg-slate-800/40 rounded-2xl text-left">
                             <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Project Kita</p>
                             <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $order->brief->company_name }}</p>
                         </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Status (Only if not paid) -->
            @if($order->status !== 'paid')
            <div @class([
                'rounded-[2.5rem] p-8 border shadow-xl shadow-slate-200/40 dark:shadow-none',
                'bg-amber-50 border-amber-200 text-amber-900 dark:bg-amber-500/10 dark:border-amber-500/30 dark:text-amber-200' => $order->status === 'pending',
                'bg-blue-50 border-blue-200 text-blue-900 dark:bg-blue-500/10 dark:border-blue-500/30 dark:text-blue-200' => $order->status === 'pending_review',
            ])>
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="font-bold">Status Pembayaran</h3>
                </div>
                <p class="text-sm mb-6 opacity-80">
                    @if($order->status === 'pending')
                        Pesanan Anda telah dicatat, silakan selesaikan pembayaran untuk memulai project.
                    @else
                        Admin kami sedang meninjau pesanan kustom Anda. Kami akan segera memberikan penawaran harga.
                    @endif
                </p>
                @if($order->status === 'pending')
                    <a href="{{ route('checkout.retry', $order->id) }}" class="w-full flex justify-center items-center py-3 bg-amber-500 text-white font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20">Bayar Sekarang</a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('discussion-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>

@endsection


