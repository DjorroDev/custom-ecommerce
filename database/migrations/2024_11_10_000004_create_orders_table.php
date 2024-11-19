<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->float('price');
            $table->string('payment_proof');
            $table->float('shipping_fee');
            $table->boolean('is_handled')->default(false);
            $table->foreignId('handled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status');
            $table->text('order_note')->nullable();
            $table->foreignId('shipment_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
