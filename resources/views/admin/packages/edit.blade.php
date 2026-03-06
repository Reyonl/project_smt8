@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Edit Paket</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Update detail paket. Perubahan akan terlihat di halaman publik.</p>
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

            <form method="POST" action="{{ route('admin.packages.update', $package->id) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Nama</label>
                    <input name="name" value="{{ old('name', $package->name) }}" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50">{{ old('description', $package->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Harga</label>
                    <input name="price" value="{{ old('price', $package->price) }}" inputmode="numeric" class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50" />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


