<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
     * Handle saving preliminary notes before payment window opens.
     */
    public function saveNotesAwal(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'notes_awal' => 'nullable|string'
        ]);

        $order->update([
            'notes_awal' => $validated['notes_awal']
        ]);

        return response()->json(['message' => 'Notes saved']);
    }

    /**
     * Show the dummy payment gateway simulation page.
     */
    public function simulateGateway(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|in:bank_transfer,e_wallet,credit_card',
            'notes_awal' => 'nullable|string',
        ]);

        // Save notes if provided
        if ($request->filled('notes_awal')) {
            $order->update(['notes_awal' => $validated['notes_awal']]);
        }

        $paymentMethod = $validated['payment_method'];

        return view('payment-gateway', compact('order', 'paymentMethod'));
    }

    /**
     * Process the simulated payment result (success or failed).
     */
    public function processPayment(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|string',
            'status' => 'required|string|in:success,failed',
        ]);

        $isSuccess = $validated['status'] === 'success';
        $orderStatus = $isSuccess ? 'paid' : 'failed';

        // Create payment record
        Payment::create([
            'order_id' => $order->id,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            'payment_type' => $validated['payment_method'],
            'status' => $isSuccess ? 'settlement' : 'deny',
        ]);

        // Update order status via service (triggers notification)
        $this->orderService->updateStatus($order, $orderStatus);

        if ($isSuccess) {
            return redirect()->route('my.orders')->with('success', 'Pembayaran berhasil! Pesanan Anda sedang diproses.');
        }

        return redirect()->route('my.orders')->with('error', 'Pembayaran gagal. Silakan coba lagi.');
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

        $order->load(['package', 'payment', 'discussions.user', 'assets']);

        return view('user.order', compact('order'));
    }

    /**
     * Retry payment for an existing order.
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

        // Catat sebagai pesanan khusus tanpa package_id, status pending_review
        $order = Order::create([
            'user_id' => auth()->id(),
            'package_id' => null, // null karena ini custom
            'order_code' => 'CUSTOM-' . time(),
            'price' => 0, // harga dikosongkan dahulu, nunggu penawaran admin
            'status' => 'pending_review',
        ]);

        // Anda bisa menyimpan deskripsi khusus di kolom terpisah jika ada,
        // misal membuat table `custom_order_details` atau simpan di json/notes
        // di sini kita asumsikan untuk simpel kita simpan pesanan. Nanti bisa ditambahkan 
        // integrasi ke admin.
        CustomOrder::create([
            'project_name' => $validated['project_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'budget' => $validated['budget'],
            'order_id' => $order->id,
        ]);

        return redirect()->route('order.show', $order->id)
                         ->with('success', 'Custom Order berhasil diajukan! Admin kami akan segera meninjaunya dan memberikan penawaran harga. Anda bisa memantau statusnya di halaman ini.');
    }

    /**
     * Show brief form for paid orders
     */
    public function briefForm(Order $order)
    {
        // Pastikan hanya owner yang bisa akses
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Pastikan status paid
        if ($order->status !== 'paid') {
            return redirect()->route('order.show', $order->id)->with('error', 'Anda hanya dapat mengisi brief untuk pesanan yang sudah lunas.');
        }

        // Pastikan brief belum ada
        if ($order->brief) {
            return redirect()->route('order.show', $order->id)->with('success', 'Anda sudah mengisi brief untuk pesanan ini.');
        }

        return view('user.brief', compact('order'));
    }

    /**
     * Store brief data
     */
    public function submitBrief(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'paid' || $order->brief) {
            return redirect()->route('order.show', $order->id)->with('error', 'Permintaan ditolak. Brief sudah ada atau order belum lunas.');
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'design_preferences' => 'nullable|string',
            'favorite_colors' => 'nullable|string|max:255',
            'additional_notes' => 'nullable|string',
        ]);

        $order->brief()->create($validated);

        // Update project_stage ke initial stage via Service
        $this->orderService->updateStage($order, 'Menganalisa Brief');

        return redirect()->route('order.show', $order->id)->with('success', 'Brief Project berhasil dikirim! Tim kami akan segera mulai mengerjakan website Anda.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
