<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'id_order' => 1, // Commande d'Amina
                'id_product' => 2, // Latte
                'quantity' => 1,
                'price' => 3500, // Prix en centimes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2, // Commande de Youssef
                'id_product' => 1, // Espresso
                'quantity' => 1,
                'price' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2, // Commande de Youssef
                'id_product' => 3, // Iced Coffee
                'quantity' => 1,
                'price' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 3, // Commande anonyme
                'id_product' => 4, // Croissant
                'quantity' => 1,
                'price' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}