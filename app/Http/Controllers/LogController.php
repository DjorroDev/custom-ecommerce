<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    function createLogForOrder(Request $request, $orderId )
    {
        $validated = $request->validate([
            'log_type' => 'required|in:order,shipment,call',
            'description' => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($orderId);

        $order->logs()->create([
            'log_type' => $validated['log_type'],
            'description' => $request['description'],
        ]);

        return redirect()->route('sales')->with('success', 'Order updated successfully.');
    }
}
