<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'kopi',
                'description' => 'blabla',
                'price' => 1000,
                'stock' => 120,
                'type_product' => 'minuman',
                'created_at' => now()
            ],
            [
                'name' => 'teh',
                'description' => 'blabla',
                'price' => 15000,
                'stock' => 110,
                'type_product' => 'minuman',
                'created_at' => now()
            ],
        ];

        Product::insert($products);
    }
}
