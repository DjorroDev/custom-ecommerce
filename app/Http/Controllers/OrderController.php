<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer', 'logs', 'orderItems.product')
        ->select('orders.*')
        ->join('logs', function ($join) {
            $join->on('logs.loggable_id', '=', 'orders.id')
                 ->where('logs.loggable_type', '=', Order::class);
        })->orderBy('created_at','desc')
        ->groupBy('orders.id')
        ->orderBy(DB::raw('MAX(logs.created_at)'), 'desc')
        ->get();
        return Inertia::render('sales/Index', [
            'orders' => $orders,
        ]);
    }

    public function uploadImage(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:8000',
        ]);

        $file = $request->file('image');

        if (!$file->isValid()) {
            return response()->json(['error' => 'Invalid file upload.'], 400);
        }

        // Store the file in the 'public/uploads' directory
        $path = $file->store('uploads', 'public');

        // Return the stored file path
        return response()->json(['path' => Storage::url($path)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // dd($request->user()->id);

        $validated = $request->validate([
            'customer.name' =>'required|string|max:255',
            'customer.phone' => 'required|string|max:15',
            'customer.address.full_address' => 'required|string',
            'customer.address.kelurahan' => 'required|string',
            'customer.address.kecamatan' => 'required|string',
            'customer.address.kota' => 'required|string',
            'customer.address.provinsi' => 'required|string',
            'customer.address.kodepos' => 'required|string|max:10',
            'customer.gender' => 'required|string',
            'order.totalPrice'=> 'required|numeric',
            'order.discount'=> 'nullable|numeric|min:0',
            'order.shippingFee'=> 'required|numeric',
            'order.paymentProof'=> 'required|string',
            'orderItems'=> 'required|array|min:1',
            'orderItems.*.id'=> 'nullable|integer', //didn't give error response to show in FE
            'orderItems.*.product_id' => 'required|integer',
            'orderItems.*.product'=> 'required|string|max:255',
            'orderItems.*.quantity'=> 'required|integer|min:1',
            'orderItems.*.price'=> 'required|numeric|min:0',
        ]);

        // dd($request, $order);
        $customer = $order->customer;

        $customer->update([
            'name' => $validated['customer']['name'],
            'phone_number_1' => $validated['customer']['phone'],
            'phone_number_2' => $validated['customer']['phoneOther'] ?? null,
            'full_address' => $validated['customer']['address']['full_address'],
            'kelurahan' => $validated['customer']['address']['kelurahan'],
            'kecamatan' => $validated['customer']['address']['kecamatan'],
            'kota' => $validated['customer']['address']['kota'],
            'provinsi' => $validated['customer']['address']['provinsi'],
            'kodepos' => $validated['customer']['address']['kodepos'],
        ]);

        $order->update([
            'price' => $validated['order']['totalPrice'],// Should manually calculate again in backend
            'discount' => $validated['order']['discount'] ?? 0,
            'shipping_fee' => $validated['order']['shippingFee'],
            'order_note' => $validated['order']['orderNote'] ?? '',
            'payment_proof'=> $validated['order']['paymentProof'],
            'status' => 'confirmed',
            'is_handled' => true,
            'handle_by' => $request->user()->id,
        ]);

          // Update or create items
        foreach ($validated['orderItems'] as $item) {
            if (isset($item['id'])) {
                OrderItem::where('id', $item['id'])->update([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            } else {
                $order->orderItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }

        // Log the update
        $order->logs()->create([
            'log_type' => 'order',
            'description' => "Order confirmed by {$request->user()->name}.",
        ]);

        return redirect()->route('sales')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
