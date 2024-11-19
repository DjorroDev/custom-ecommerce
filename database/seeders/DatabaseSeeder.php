<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Customer::create([
            'name'=> 'HENDRA JOKO SUSILO',
            'full_address' => 'PERUMAHAN GRIYA PERMAI BLOK G 1 NO 5',
            'kelurahan' =>'Caringin',
            'kecamatan' => 'Legok',
            'kota' => 'Tangerang',
            'provinsi' => 'Banten',
            'kodepos' => '15820',
            'phone_number_1' => '08131897934',
        ]);

        Customer::create([
            'name'=> 'ANNA VERA SIPAHUTAR',
            'full_address' => 'PERUM DASANA INDAH BLOK SJ 7 NO 18',
            'kelurahan' =>'BOJONG NANGKA',
            'kecamatan' => 'KELAPA DUA',
            'kota' => 'Tangerang',
            'provinsi' => 'Banten',
            'kodepos' => '15810',
            'phone_number_1' => '085283897062',
            'phone_number_2' => '081219651492',
        ]);


        Product::create([
            'name'=> 'Ginseng Anti kerut',
            'stock' => '500',
            'price' => '200000'
        ]);

        Order::factory(5)->withItems(1)->create();

    }
}
