<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'order_code',
        'notes_awal',
        'price',
        'status',
        'project_stage'
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

    public function brief()
    {
        return $this->hasOne(OrderBrief::class);
    }

    public function discussions()
    {
        return $this->hasMany(OrderDiscussion::class);
    }

    public function assets()
    {
        return $this->hasMany(OrderAsset::class);
    }
}
