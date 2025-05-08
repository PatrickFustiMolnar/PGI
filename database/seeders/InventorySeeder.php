<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventories')->insert([
            [
                'name' => 'Grains de café arabica',
                'stock' => 50,
                'unit' => 'kg',
                'supplier_id' => 1,
            ],
            [
                'name' => 'Lait entier',
                'stock' => 100,
                'unit' => 'litres',
                'supplier_id' => 1,
            ],
            [
                'name' => 'Sucre en poudre',
                'stock' => 20,
                'unit' => 'kg',
                'supplier_id' => 1,
            ],
        ]);
    }
}