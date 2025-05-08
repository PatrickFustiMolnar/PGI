<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Discount::create([
            'name' => 'Happy Hour Café',
            'description' => '10% sur toutes les boissons chaudes de 15h à 17h',
            'type' => 'percentage',
            'value' => 10.00,
            'status' => 'active',
            'expired_date' => '2025-12-31',
        ]);
        \App\Models\Discount::create([
            'name' => 'Combo Matin',
            'description' => '20% sur un café + une pâtisserie',
            'type' => 'percentage',
            'value' => 20.00,
            'status' => 'active',
            'expired_date' => '2025-06-30',
        ]);
    }
}