<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $paidOrders = Order::where('user_id', $user->id)->where('status', 'paid')->count();
        $totalSpent = Order::where('user_id', $user->id)->where('status', 'paid')->sum('price');
        $recentOrders = Order::where('user_id', $user->id)->with('package')->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'totalOrders', 'pendingOrders', 'paidOrders', 'totalSpent', 'recentOrders'
        ));
    }

    public function checkout($id)
    {
        $package = Package::findOrFail($id);

        $order = Order::create([
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'order_code' => 'ORDER-' . time(),
            'price' => $package->price,
            'status' => 'pending'
        ]);

        // Load package for UI preview in checkout page
        $order->setRelation('package', $package);

        return view('checkout', compact('order'));
    }

    /**
     * Tampilkan Dummy Gateway
     */
    public function manualPayment(Order $order)
    {
        if ($order->user_id !== auth()->id() || $order->status === 'paid') {
            abort(403, 'Akses tidak sah atau pesanan sudah dibayar.');
        }

        $order->load('package');
        return view('payment-upload', compact('order'));
    }

    /**
     * Proses hasil dari Dummy Gateway
     */
    public function processManualPayment(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id() || $order->status === 'paid') {
            abort(403);
        }

        $request->validate([
            'proof_image' => 'required|image|max:5120'
        ]);

        $path = $request->file('proof_image')->store('payment_proofs', 'public');

        Payment::create([
            'order_id' => $order->id,
            'transaction_id' => 'MANUAL-' . strtoupper(uniqid()),
            'payment_type' => 'bank_transfer',
            'status' => 'pending',
            'proof_image' => $path
        ]);

        $order->status = 'pending_verification';
        $order->save();

        return redirect()->route('my.orders')->with('success', 'Bukti pembayaran berhasil diunggah. Silakan menunggu konfirmasi Admin.');
    }

    /**
     * Show the authenticated user's orders.
     */
    public function myOrders()
    {
        $orders = Order::with(['package', 'payment'])->where('user_id', auth()->id())->latest()->get();

        return view('user.my-orders', compact('orders'));
    }

    /**
     * Show a single order detail for the authenticated user.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['package', 'payment']);

        return view('user.order', compact('order'));
    }

    /**
     * Retry payment for an existing order by showing checkout view without regenerating token.
     */
    public function retry(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow retry if not already paid
        if ($order->status === 'paid') {
            return redirect()->route('my.orders')->with('info', 'Order already paid.');
        }

        $order->loadMissing('package');

        return view('checkout', compact('order'));
    }

    /**
     * Show form for ordering a Custom Website.
     */
    public function customOrderForm()
    {
        return view('custom-order');
    }

    /**
     * Handle submission of custom website order form.
     */
    public function submitCustomOrder(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'budget' => 'nullable|string|max:100',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'package_id' => null, 
            'order_code' => 'CUSTOM-' . time(),
            'price' => 0, 
            'status' => 'pending_review',
            'custom_details' => [
                'project_name' => $validated['project_name'],
                'category' => $validated['category'],
                'description' => $validated['description'],
                'budget' => $validated['budget'] ?? null,
            ]
        ]);

        return redirect()->route('custom.order')->with('success', 'Pengajuan Custom Website Anda telah kami terima. Tim kami akan segera meninjaunya dan memberikan penawaran harga.');
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Order $order)
    {
    }

    public function update(Request $request, Order $order)
    {
    }

    public function destroy(Order $order)
    {
    }
}
