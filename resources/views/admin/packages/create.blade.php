@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Buat Paket Baru</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Isi informasi paket dengan jelas agar user mudah memilih.</p>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Kembali</a>
    </div>

    <div class="mt-6 card">
        <div class="card-body">
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-200">
                    <p class="font-semibold">Periksa input:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.packages.store') }}" class="space-y-5" enctype="multipart/form-data">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Nama</label>
                    <input name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50" placeholder="Contoh: Company Profile" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50" placeholder="Ringkas, jelas, dan benefit-oriented.">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Harga</label>
                    <input name="price" value="{{ old('price') }}" inputmode="numeric" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50" placeholder="Contoh: 2500000" />
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Masukkan angka tanpa titik/koma.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Foto / Preview</label>
                    <input name="image" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full text-sm text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800 dark:text-slate-200 dark:file:bg-slate-100 dark:file:text-slate-900 dark:hover:file:bg-white" />
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">JPG/PNG/WebP, maks 2MB. Rekomendasi rasio 16:9.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


