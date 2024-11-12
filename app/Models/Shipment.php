<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public function loggable() {
        return $this->morphMany(Log::class, 'loggable');
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }}
