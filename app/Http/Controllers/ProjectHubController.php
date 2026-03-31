<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderAsset;
use App\Models\OrderDiscussion;
use Illuminate\Support\Facades\Storage;

class ProjectHubController extends Controller
{
    /**
     * Send a project discussion message.
     */
    public function sendMessage(Request $request, Order $order)
    {
        // Permission check: User must be owner or Admin
        if (auth()->id() !== $order->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $order->discussions()->create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Pesan berhasil terkirim.');
    }

    /**
     * Download a project asset.
     */
    public function downloadAsset(OrderAsset $asset)
    {
        $order = $asset->order;

        // Permission check
        if (auth()->id() !== $order->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return Storage::disk('public')->download($asset->file_path, $asset->file_name);
    }
}
