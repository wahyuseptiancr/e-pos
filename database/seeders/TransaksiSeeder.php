<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksis = [
            [
                'product_id' => 1,
                'qty' => 10,
                'created_at' => now()
            ],
            [
                'product_id' => 2,
                'qty' => 20,
                'created_at' => now()
            ]
        ];

        Transaksi::insert($transaksis);
    }
}
