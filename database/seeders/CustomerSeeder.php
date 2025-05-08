<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'Jean Dupont',
                'phone_number' => '0612345678',
                'email' => 'jean.dupont@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marie Martin',
                'phone_number' => '0623456789',
                'email' => 'marie.martin@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Julien Lefèvre',
                'phone_number' => '0634567890',
                'email' => 'julien.lefevre@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sophie Bernard',
                'phone_number' => '0645678901',
                'email' => 'sophie.bernard@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lucie Girard',
                'phone_number' => '0656789012',
                'email' => 'lucie.girard@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pierre Moreau',
                'phone_number' => '0667890123',
                'email' => 'pierre.moreau@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camille Laurent',
                'phone_number' => '0678901234',
                'email' => 'camille.laurent@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nicolas Robert',
                'phone_number' => '0689012345',
                'email' => 'nicolas.robert@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Julie Dubois',
                'phone_number' => '0690123456',
                'email' => 'julie.dubois@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Antoine Simon',
                'phone_number' => '0611111111',
                'email' => null, // Client sans email
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}