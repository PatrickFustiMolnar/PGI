<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'user_id' => 1,
                'name' => 'Ahmed Barista',
                'phone' => '0612345678',
                'position' => 'Barista',
                'date_of_birth' => '1990-05-15',
                'date_of_joining' => '2023-01-01',
                'salary' => 4000.00,
                'address' => '12 Rue du Café, Marrakech',
            ],
            [
                'user_id' => 2,
                'name' => 'Fatima Serveuse',
                'phone' => '0623456789',
                'position' => 'Serveuse',
                'date_of_birth' => '1995-08-20',
                'date_of_joining' => '2023-06-01',
                'salary' => 3000.00,
                'address' => '34 Avenue des Thés, Agadir',
            ],
        ]);
    }
}