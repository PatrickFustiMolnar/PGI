<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Category::create([
            'name' => 'Boissons chaudes',
            'description' => 'Cafés, thés et autres boissons servies chaudes',
            'image' => 'hot_drinks.jpg',
        ]);
        \App\Models\Category::create([
            'name' => 'Boissons froides',
            'description' => 'Cafés glacés, jus et smoothies',
            'image' => 'cold_drinks.jpg',
        ]);
        \App\Models\Category::create([
            'name' => 'Pâtisseries',
            'description' => 'Croissants, muffins et gâteaux',
            'image' => 'pastries.jpg',
        ]);
        \App\Models\Category::create([
            'name' => 'Snacks',
            'description' => 'Sandwichs et petites collations',
            'image' => 'snacks.jpg',
        ]);
    }
}