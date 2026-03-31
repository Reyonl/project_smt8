<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::with('package','user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('package', 'user', 'payment', 'discussions.user', 'assets', 'brief');
        return view('admin.orders.show', compact('order'));
    }

    public function updatePrice(\Illuminate\Http\Request $request, Order $order)
    {
        $request->validate([
            'price' => 'required|numeric|min:1'
        ]);

        if ($order->status === 'pending_review' && !$order->package_id) {
            $this->orderService->updateData($order, [
                'price' => $request->price,
                'status' => 'pending'
            ], 'Harga custom order Anda telah ditentukan. Silakan lakukan pembayaran.');

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

    public function updateStage(Request $request, Order $order)
    {
        $request->validate([
            'project_stage' => 'required|string|max:255'
        ]);

        if ($order->status !== 'paid') {
            return back()->with('error', 'Hanya pesanan berstatus Lunas (Paid) yang memiliki Project Stage.');
        }

        $this->orderService->updateStage($order, $request->project_stage);

        return back()->with('success', 'Project Stage berhasil di-update. Klien dapat melihat perubahan ini di dashboard mereka.');
    }
}