<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function order_items() {
        return $this->hasMany(OrderItem::class);
    }
}
