<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAsset extends Model
{
    protected $fillable = ['order_id', 'file_name', 'file_path', 'type', 'size'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
