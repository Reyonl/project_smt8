@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-50">Checkout</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Konfirmasi order dan lanjut ke pembayaran.</p>
        </div>
        <a href="{{ route('my.orders') }}" class="btn btn-outline">Pesanan Saya</a>
    </div>

    <div class="mt-6 card">
        <div class="card-body">
            @if(optional($order->package)->image_path)
                <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200/70 bg-slate-100 dark:border-slate-800/70 dark:bg-slate-950/30">
                    <img
                        src="{{ asset('storage/' . $order->package->image_path) }}"
                        alt="Preview {{ $order->package->name }}"
                        class="aspect-video w-full object-cover"
                        loading="lazy"
                    />
                </div>
            @endif

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Order Code</p>
                    <p class="mt-1 font-semibold text-slate-900 dark:text-slate-50">{{ $order->order_code }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Bayar</p>
                    <p class="mt-1 text-lg font-semibold text-indigo-600 dark:text-indigo-300">Rp {{ number_format($order->price) }}</p>
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-slate-200/70 bg-slate-50 p-4 text-sm text-slate-700 dark:border-slate-800/70 dark:bg-slate-950/30 dark:text-slate-200">
                Klik tombol di bawah untuk membuka metode pembayaran. Jangan tutup halaman ini saat proses pembayaran berlangsung.
            </div>

            <div class="mt-6">
                <button id="pay-button" class="btn btn-primary w-full">
                    <span id="pay-label">Bayar Sekarang</span>
                    <span id="pay-spinner" class="hidden h-4 w-4 animate-spin rounded-full border-2 border-white/40 border-t-white" role="status" aria-hidden="true"></span>
                </button>
                <p id="pay-hint" class="mt-2 text-center text-xs text-slate-500 dark:text-slate-400">Pembayaran diproses via Midtrans Snap.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script>
    (function () {
        var btn = document.getElementById('pay-button');
        var label = document.getElementById('pay-label');
        var spinner = document.getElementById('pay-spinner');

        function setLoading(isLoading) {
            btn.disabled = isLoading;
            spinner.classList.toggle('hidden', !isLoading);
            label.textContent = isLoading ? 'Mengalihkan...' : 'Bayar Sekarang';
        }

        btn.addEventListener('click', function () {
            setLoading(true);

            snap.pay(@json($snapToken), {
                onSuccess: function (result) {
                    fetch(@json(route('payment.result')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': @json(csrf_token())
                        },
                        body: JSON.stringify(result)
                    })
                    .then(function (res) { return res.json(); })
                    .then(function () {
                        window.location = @json(route('my.orders'));
                    })
                    .catch(function (err) {
                        console.error(err);
                        alert('Pembayaran berhasil, tapi terjadi kesalahan saat menyimpan ke server. Coba refresh dan cek Pesanan Saya.');
                        setLoading(false);
                    });
                },

                onPending: function (result) {
                    fetch(@json(route('payment.result')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': @json(csrf_token())
                        },
                        body: JSON.stringify(result)
                    }).finally(function () {
                        window.location = @json(route('my.orders'));
                    });
                },

                onError: function (result) {
                    fetch(@json(route('payment.result')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': @json(csrf_token())
                        },
                        body: JSON.stringify(result)
                    }).finally(function () {
                        alert('Pembayaran gagal. Silakan coba lagi.');
                        setLoading(false);
                    });
                },

                onClose: function () {
                    // user closed the popup without completing payment
                    setLoading(false);
                }
            });
        });
    })();
</script>

@endsection


