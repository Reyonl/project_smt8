<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('package','user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('package', 'user', 'payment');
        return view('admin.orders.show', compact('order'));
    }

    public function updatePrice(\Illuminate\Http\Request $request, Order $order)
    {
        $request->validate([
            'price' => 'required|numeric|min:1'
        ]);

        if ($order->status === 'pending_review' && !$order->package_id) {
            $order->update([
                'price' => $request->price,
                'status' => 'pending' // Setelah harga diset, status jadi pending (harus dibayar user)
            ]);

            return redirect()->route('admin.orders.show', $order->id)->with('success', 'Harga custom order berhasil diset. Status pesanan sekarang Menunggu Pembayaran dari klien.');
        }

        return back()->with('error', 'Pesanan ini tidak bisa diubah harganya.');
    }

    public function cancel(Order $order)
    {
        // Cegah pembatalan jika pesanan sudah dibayar (paid)
        if ($order->status === 'paid') {
            return back()->with('error', 'Pesanan yang sudah lunas tidak dapat dibatalkan melalui sistem ini.');
        }

        if ($order->status === 'cancelled' || $order->status === 'failed') {
            return back()->with('error', 'Pesanan ini sudah dibatalkan sebelumnya.');
        }

        $order->update([
            'status' => 'cancelled' // atau bisa diset ke 'failed'
        ]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Pesanan berhasil dibatalkan secara manual.');
    }
}