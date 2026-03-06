<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     public function __construct()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
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

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout', compact('snapToken', 'order'));
    }

    /**
     * Handle payment result from the client (Snap onSuccess/onPending/onError).
     */
    public function paymentResult(Request $request)
    {
        $data = $request->all();

        // Expecting Midtrans result object posted from the client
        $orderCode = $data['order_id'] ?? null; // this is the order_id we set in transaction_details

        if (! $orderCode) {
            return response()->json(['message' => 'order_id missing'], 422);
        }

        $order = Order::where('order_code', $orderCode)->first();

        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Create or update payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'transaction_id' => $data['transaction_id'] ?? null,
            'payment_type' => $data['payment_type'] ?? null,
            'status' => $data['transaction_status'] ?? ($data['status'] ?? 'unknown'),
        ]);

        // Map Midtrans statuses to our order status
        $txStatus = $data['transaction_status'] ?? ($data['status'] ?? null);

        if (in_array($txStatus, ['capture', 'settlement'])) {
            $order->status = 'paid';
        } elseif (in_array($txStatus, ['pending'])) {
            $order->status = 'pending';
        } else {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['message' => 'Payment recorded', 'order_status' => $order->status]);
    }

    /**
     * Handle Midtrans server-to-server notification (HTTP POST).
     * This endpoint verifies signature_key and updates payment/order accordingly.
     */
    public function notification(Request $request)
    {
        $data = $request->all();

        // Required fields from Midtrans
        $orderId = $data['order_id'] ?? null;
        $statusCode = $data['status_code'] ?? null;
        $grossAmount = $data['gross_amount'] ?? null;
        $signatureKey = $data['signature_key'] ?? null;

        if (! $orderId || ! $statusCode || ! $grossAmount || ! $signatureKey) {
            return response('Bad Request', 400);
        }

        // verify signature
        $serverKey = config('midtrans.serverKey');
        $expected = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if (! hash_equals($expected, $signatureKey)) {
            return response('Invalid signature', 403);
        }

        // find order
        $order = Order::where('order_code', $orderId)->first();
        if (! $order) {
            return response('Order not found', 404);
        }

        // create or update payment
        $payment = Payment::updateOrCreate(
            ['transaction_id' => $data['transaction_id'] ?? null],
            [
                'order_id' => $order->id,
                'transaction_id' => $data['transaction_id'] ?? null,
                'payment_type' => $data['payment_type'] ?? null,
                'status' => $data['transaction_status'] ?? ($data['status'] ?? null),
            ]
        );

        $txStatus = $data['transaction_status'] ?? ($data['status'] ?? null);

        if (in_array($txStatus, ['capture', 'settlement'])) {
            $order->status = 'paid';
        } elseif (in_array($txStatus, ['pending'])) {
            $order->status = 'pending';
        } else {
            $order->status = 'failed';
        }

        $order->save();

        // respond OK so Midtrans knows notification was received
        return response('OK', 200);
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
     * Retry payment for an existing order: generate a new Snap token and return checkout view.
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

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->loadMissing('package');

        return view('checkout', compact('snapToken', 'order'));
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
