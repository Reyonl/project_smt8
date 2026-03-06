@extends('layouts.app')

@section('content')

<div class="grid gap-6 lg:grid-cols-3">
    <div class="card lg:col-span-2">
        <div class="card-body">
            <h1 class="text-xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Dashboard</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                Selamat datang, <span class="font-semibold text-slate-900 dark:text-slate-50">{{ auth()->user()->name }}</span>.
                Pantau status pesanan dan lanjutkan pembayaran jika masih pending.
            </p>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('packages') }}" class="btn btn-primary">Pilih Paket</a>
                <a href="{{ route('my.orders') }}" class="btn btn-outline">Lihat Pesanan Saya</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-50">Akun</h2>
            <div class="mt-3 space-y-2 text-sm">
                <div class="flex items-center justify-between gap-3">
                    <span class="text-slate-600 dark:text-slate-300">Email</span>
                    <span class="font-medium text-slate-900 dark:text-slate-50">{{ auth()->user()->email }}</span>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <span class="text-slate-600 dark:text-slate-300">Role</span>
                    <span class="badge badge-success">user</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="btn btn-secondary w-full">Edit Profil</a>
            </div>
        </div>
    </div>
</div>

@endsection


