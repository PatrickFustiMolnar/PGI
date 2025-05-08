<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'reservation_code' => 'RES001',
                'reservation_date' => now()->addDay()->toDateString(), // Demain
                'reservation_time' => '14:00:00',
                'status' => 'pending',
                'notes' => 'Près de la fenêtre',
                'table_number' => 'T1',
                'customer_name' => 'Amina El Fassi',
                'customer_phone' => '0612345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_code' => 'RES002',
                'reservation_date' => now()->toDateString(), // Aujourd'hui
                'reservation_time' => '18:30:00',
                'status' => 'confirmed',
                'notes' => 'Groupe de 4 personnes',
                'table_number' => 'T3',
                'customer_name' => 'Youssef Benali',
                'customer_phone' => '0623456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservation_code' => 'RES003',
                'reservation_date' => now()->subDay()->toDateString(), // Hier
                'reservation_time' => '12:00:00',
                'status' => 'completed',
                'notes' => null,
                'table_number' => 'T2',
                'customer_name' => 'Sara Lahlou',
                'customer_phone' => '0634567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}