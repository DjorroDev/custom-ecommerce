<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> 'HENDRA JOKO SUSILO',
            'address' => 'PERUMAHAN GRIYA PERMAI BLOK G 1 NO 5',
            'kelurahan' =>'Caringin',
            'kecamatan' => 'Legok',
            'kota' => 'Tangerang',
            'kodepos' => '15820',
            'phone_number_1' => '08131897934',
        ];
    }
}
