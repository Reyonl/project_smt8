<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Buat akun</h2>
        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
            Untuk memantau pesanan, status pembayaran, dan akses fitur setelah checkout.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-200">
            <p class="font-semibold">Periksa input:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50"
                placeholder="Nama kamu" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50"
                placeholder="nama@email.com" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50"
                placeholder="Minimal 8 karakter" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-900 dark:text-slate-50">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                class="mt-2 w-full rounded-xl border-slate-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-50"
                placeholder="Ulangi password" />
        </div>

        <div class="pt-2 space-y-3">
            <button type="submit" class="btn btn-primary w-full">Daftar</button>

            <div class="text-center text-sm text-slate-600 dark:text-slate-300">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-300 dark:hover:text-indigo-200">Login</a>
            </div>
        </div>
    </form>
</x-guest-layout>
