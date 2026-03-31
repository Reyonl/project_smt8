<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBrief extends Model
{
    protected $fillable = [
        'order_id',
        'company_name',
        'business_type',
        'design_preferences',
        'favorite_colors',
        'additional_notes'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
