<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\CustomOrderReviewed;
use Illuminate\Http\Request;

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
                'status' => 'pending' 
            ]);

            $order->user->notify(new CustomOrderReviewed($order, 'Disetujui', 'Pesanan Custom Anda disetujui. Silakan lakukan pembayaran.'));

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

    public function verifyPayment(Order $order)
    {
        if ($order->status !== 'pending_verification') {
            return back()->with('error', 'Pesanan ini tidak memerlukan verifikasi pembayaran.');
        }

        $order->update(['status' => 'paid']);
        if ($order->payment) {
            $order->payment->update(['status' => 'success']);
        }

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Pembayaran telah diverifikasi. Pesanan ditandai Lunas.');
    }

    public function rejectPayment(Order $order)
    {
        if ($order->status !== 'pending_verification') {
            return back()->with('error', 'Pesanan ini tidak memerlukan verifikasi pembayaran.');
        }

        $order->update(['status' => 'pending']);
        if ($order->payment) {
            $order->payment->update(['status' => 'failed']);
        }

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Bukti pembayaran ditolak. Status dikembalikan ke Pending.');
    }

    public function rejectCustomForm(Request $request, Order $order)
    {
        if ($order->status !== 'pending_review' || $order->package_id) {
            return back()->with('error', 'Hanya Custom Order yang butuh review awal yang bisa ditolak lewat skema ini.');
        }

        $request->validate([
            'reject_reason' => 'required|string|max:500'
        ]);

        $customDetails = $order->custom_details ?? [];
        $customDetails['reject_reason'] = $request->reject_reason;

        $order->update([
            'status' => 'cancelled',
            'custom_details' => $customDetails
        ]);

        $order->user->notify(new CustomOrderReviewed($order, 'Ditolak', $request->reject_reason));

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Custom Order berhasil ditolak. Notifikasi telah dikirim ke pelanggan.');
    }
}