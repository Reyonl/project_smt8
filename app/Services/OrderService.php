<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderStatusUpdated;

class OrderService
{
    /**
     * Update order status and handle related actions like notifications.
     */
    public function updateStatus(Order $order, string $status, array $paymentData = [])
    {
        return DB::transaction(function () use ($order, $status, $paymentData) {
            $oldStatus = $order->status;
            $order->status = $status;
            $order->save();

            if (!empty($paymentData)) {
                Payment::updateOrCreate(
                    ['transaction_id' => $paymentData['transaction_id'] ?? null],
                    [
                        'order_id' => $order->id,
                        'payment_type' => $paymentData['payment_type'] ?? null,
                        'status' => $paymentData['transaction_status'] ?? ($paymentData['status'] ?? null),
                    ]
                );
            }

            if ($oldStatus !== $status) {
                // Notify user if needed
                $this->notifyUser($order, "Status pesanan Anda telah berubah menjadi " . ucfirst($status));
            }

            return $order;
        });
    }

    /**
     * Update order data (like price) and notify.
     */
    public function updateData(Order $order, array $data, string $notificationMessage = null)
    {
        return DB::transaction(function () use ($order, $data, $notificationMessage) {
            $order->update($data);

            if ($notificationMessage) {
                $this->notifyUser($order, $notificationMessage);
            }

            return $order;
        });
    }

    /**
     * Update project stage and notify user.
     */
    public function updateStage(Order $order, string $stage)
    {
        return DB::transaction(function () use ($order, $stage) {
            $order->project_stage = $stage;
            $order->save();

            $this->notifyUser($order, "Progres proyek Anda: " . $stage);

            return $order;
        });
    }

    private function notifyUser(Order $order, string $message)
    {
        if (class_exists(\App\Notifications\OrderStatusUpdated::class)) {
            $order->user->notify(new OrderStatusUpdated($order, $message));
        }
    }
}
