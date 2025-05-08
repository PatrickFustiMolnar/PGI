<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            SupplierSeeder::class,  
            CategorySeeder::class,  
            ProductSeeder::class,  
            DiscountSeeder::class,
            InventorySeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,     
            OrderItemSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}