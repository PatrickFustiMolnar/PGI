<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Café du Maroc',
                'address' => '123 Rue des Caféiers, Casablanca',
                'phone' => '0522345678',
            ],
            [
                'name' => 'Laiterie Locale',
                'address' => '456 Avenue du Lait, Rabat',
                'phone' => '0537456789',
            ],
        ]);
    }
}