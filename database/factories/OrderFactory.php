<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 2),
            'price' => $this->faker->randomFloat(2, 100000, 500000),
            'payment_proof' => $this->faker->imageUrl(),
            'shipping_fee' => 10000,
            'is_handled' => false,
            'handled_by' => null,
            'status' => 'pending',
            'shipment_id' => null,
            'order_note' => null,
        ];
    }

    public function withItems($count = 3)
    {
        return $this->has(\App\Models\OrderItem::factory()->count($count), 'orderItems');
    }
}
