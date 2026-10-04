<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'order_code',
        'price',
        'status',
        'custom_details'
    ];

    protected $casts = [
        'custom_details' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates()
    {
        return $this->hasMany(OrderUpdate::class)->orderBy('created_at', 'asc');
    }

    /**
     * Check if the order is considered paid (Lunas).
     */
    public function isPaid(): bool
    {
        return in_array($this->status, ['paid', 'processing', 'revision', 'completed']);
    }

    /**
     * Scope for orders considered paid (Lunas).
     */
    public function scopePaid($query)
    {
        return $query->whereIn('status', ['paid', 'processing', 'revision', 'completed']);
    }
}
