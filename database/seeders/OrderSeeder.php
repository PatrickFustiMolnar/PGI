<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id_customer' => 1, // Amina
                'payment_amount' => '3500', // En centimes (35,00 MAD)
                'sub_total' => 3500,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 3500,
                'payment_method' => 'especes', // 1 = especes
                'total_item' => 1,
                'transaction_time' => now()->subHours(2)->toDateTimeString(), // Commande passée il y a 2h
                'order_type' => 'dinein',
                'status' => 'served',
            ],
            [
                'id_customer' => 2, // Youssef
                'payment_amount' => '6000',
                'sub_total' => 6000,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 6000,
                'payment_method' => 'carte', // 2 = carte
                'total_item' => 2,
                'transaction_time' => now()->subHour(1)->toDateTimeString(), // Commande passée il y a 1h
                'order_type' => 'takeaway',
                'status' => 'ready',
            ],
            [
                'id_customer' => null, // Client anonyme
                'payment_amount' => '1500',
                'sub_total' => 1500,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 1500,
                'payment_method' => 'especes',
                'total_item' => 1,
                'transaction_time' => now()->toDateTimeString(), // Commande récente
                'order_type' => 'dinein',
                'status' => 'pending',
            ],
            [
                'id_customer' => 3, // Sara par exemple
                'payment_amount' => '4500',
                'sub_total' => 4500,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 4500,
                'payment_method' => 'carte',
                'total_item' => 1,
                'transaction_time' => now()->subMinutes(45)->toDateTimeString(), // Commande passée il y a 45 minutes
                'order_type' => 'dinein',
                'status' => 'served',
            ],
            [
                'id_customer' => 1, // Amina
                'payment_amount' => '5000',
                'sub_total' => 5000,
                'tax' => 0,
                'discount' => 500, // Remise de 500 centimes
                'service_charge' => 0,
                'total' => 4500,
                'payment_method' => 'especes',
                'total_item' => 2,
                'transaction_time' => now()->subHours(3)->toDateTimeString(), // Commande passée il y a 3 heures
                'order_type' => 'takeaway',
                'status' => 'ready',
            ],
            [
                'id_customer' => 2, // Youssef
                'payment_amount' => '7750',
                'sub_total' => 7500,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 250, // Frais de service
                'total' => 7750,
                'payment_method' => 'carte',
                'total_item' => 3,
                'transaction_time' => now()->subHours(5)->toDateTimeString(), // Commande passée il y a 5 heures
                'order_type' => 'dinein',
                'status' => 'served',
            ],
            [
                'id_customer' => null, // Commande d'un client anonyme
                'payment_amount' => '3200',
                'sub_total' => 3200,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 3200,
                'payment_method' => 'especes',
                'total_item' => 1,
                'transaction_time' => now()->subMinutes(30)->toDateTimeString(), // Commande passée il y a 30 minutes
                'order_type' => 'takeaway',
                'status' => 'pending',
            ],
            [
                'id_customer' => 4, // Nouveau client, par exemple
                'payment_amount' => '6000',
                'sub_total' => 6000,
                'tax' => 0,
                'discount' => 0,
                'service_charge' => 0,
                'total' => 6000,
                'payment_method' => 'carte',
                'total_item' => 2,
                'transaction_time' => now()->subHours(6)->toDateTimeString(), // Commande passée il y a 6 heures
                'order_type' => 'dinein',
                'status' => 'ready',
            ],
        ]);
    }
}