<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    /**
     * Download invoice as PDF.
     */
    public function download(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($order->status !== 'paid') {
            return back()->with('error', 'Invoice hanya tersedia untuk pesanan yang sudah lunas.');
        }

        $order->load(['package', 'user', 'payment']);

        $pdf = Pdf::loadView('invoices.order_invoice', compact('order'));
        
        return $pdf->download('Invoice-' . $order->order_code . '.pdf');
    }
}
