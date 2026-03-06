@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Kelola Paket</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Tambah, edit, dan hapus paket yang ditawarkan.</p>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">Buat Paket Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $p)
                        <tr>
                            <td class="font-medium text-slate-900 dark:text-slate-50">{{ $p->name }}</td>
                            <td class="text-slate-700 dark:text-slate-200">Rp {{ number_format($p->price) }}</td>
                            <td class="text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.packages.edit', $p->id) }}" class="btn btn-outline">Edit</a>

                                    <form action="{{ route('admin.packages.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-600 dark:text-slate-300">Belum ada paket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


