<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
     use HasFactory;

     protected $fillable = [
        'customer_id', 'price', 'payment_proof', 'shipping_fee',
        'is_handled', 'handled_by', 'status', 'shipment_id', 'log_id'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function shipment() {
        return $this->hasOne(Shipment::class);
    }

    public function loggable() {
        return $this->morphMany(Log::class, 'loggable');
    }
}
