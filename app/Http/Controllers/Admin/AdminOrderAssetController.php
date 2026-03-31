<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderAsset;

class AdminOrderAssetController extends Controller
{
    /**
     * Admin uploads an asset to an order.
     */
    public function upload(Request $request, Order $order)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // Max 20MB
            'file_name' => 'nullable|string|max:255',
            'type' => 'required|in:draft,final,resource',
        ]);

        $file = $request->file('file');
        $fileName = $request->file_name ?: $file->getClientOriginalName();
        
        // Store the file
        $path = $file->storeAs(
            'orders/' . $order->id, 
            time() . '_' . $file->getClientOriginalName(), 
            'public'
        );

        $order->assets()->create([
            'file_name' => $fileName,
            'file_path' => $path,
            'type' => $request->type,
            'size' => $this->formatBytes($file->getSize()),
        ]);

        return back()->with('success', 'File berhasil diunggah.');
    }

    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
