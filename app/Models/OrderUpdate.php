<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderUpdate extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'message',
        'attachment_path',
        'is_admin_update'
    ];

    protected $casts = [
        'is_admin_update' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
