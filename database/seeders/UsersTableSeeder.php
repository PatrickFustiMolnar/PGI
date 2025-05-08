<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Fusti Molnar Patrick',
                'email' => 'patrick@gmail.com',
                'password' => Hash::make('patrick@gmail.com'),
                'role' => 'admin',
            ],
            [
                'name' => 'Barista 1',
                'email' => 'barista@coffee.com',
                'password' => Hash::make('barista123'),
                'role' => 'employe',
            ],
            [
                'name' => 'Client Smart',
                'email' => 'client@coffee.com',
                'password' => Hash::make('client123'),
                'role' => 'utilisateur',
            ],
        ]);
    }
}