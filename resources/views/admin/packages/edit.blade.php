@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 mb-4">
                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Edit Layanan</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Edit: {{ $package->name }}</h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">Update harga, deskripsi, atau gambar untuk paket ini.</p>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Batal
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-rose-100 dark:bg-rose-500/20 rounded-full text-rose-600 dark:text-rose-400 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-rose-800 dark:text-rose-300 font-bold text-sm mb-1">Periksa Input Anda:</p>
                <ul class="list-disc pl-4 space-y-1 text-sm text-rose-700 dark:text-rose-400">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none overflow-hidden p-6 md:p-10">
        <form method="POST" action="{{ route('admin.packages.update', $package->id) }}" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="p-1.5 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-md"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></span>
                    Informasi Layanan
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Paket <span class="text-rose-500">*</span></label>
                        <input name="name" value="{{ old('name', $package->name) }}" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Harga (Rp) <span class="text-rose-500">*</span></label>
                        <input name="price" value="{{ old('price', $package->price) }}" required inputmode="numeric" type="number" min="0" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow font-mono" />
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Ketik angka saja tanpa titik/koma.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Layanan & Fitur</label>
                        <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 px-4 py-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-shadow">{{ old('description', $package->description) }}</textarea>
                    </div>
                </div>
            </div>

            <hr class="border-slate-200 dark:border-slate-800">

            <!-- Media -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="p-1.5 bg-fuchsia-100 dark:bg-fuchsia-500/20 text-fuchsia-600 dark:text-fuchsia-400 rounded-md"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></span>
                    Visual / Gambar Cover
                </h3>
                
                @if($package->image_path)
                    <div class="mb-4 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden max-w-sm">
                        <img src="{{ asset('storage/' . $package->image_path) }}" alt="Preview {{ $package->name }}" class="w-full aspect-video object-cover" />
                    </div>
                @endif

                <div class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-2xl p-6 text-center bg-slate-50/50 dark:bg-slate-800/20 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <div class="flex text-sm text-slate-600 dark:text-slate-400 justify-center">
                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-500">
                            <span>Upload Thumbnail Baru</span>
                            <input id="file-upload" name="image" type="file" class="sr-only" accept="image/png,image/jpeg,image/webp">
                        </label>
                    </div>
                    <p class="text-xs text-slate-500 mt-2" id="filename-display">Abaikan jika tidak ingin mengganti gambar. PNG, JPG, WebP maksimal 2MB (16:9)</p>
                </div>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row sm:justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}" class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Batal</a>
                <button type="submit" class="inline-flex justify-center items-center px-8 py-3 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold hover:opacity-90 transition-opacity shadow-lg shadow-slate-900/20 dark:shadow-white/10">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        document.getElementById('filename-display').textContent = 'Selected: ' + fileName;
    });
</script>

@endsection
