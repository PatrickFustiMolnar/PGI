<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Product::create([
            'category_id' => 1, // Boissons chaudes
            'name' => 'Espresso',
            'description' => 'Café noir intense',
            'image' => 'espresso.jpg',
            'price' => 2500, // En centimes (25,00 MAD par exemple)
            'stock' => 100,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Latte',
            'description' => 'Café au lait mousseux',
            'image' => 'latte.jpg',
            'price' => 3500,
            'stock' => 80,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 2, // Boissons froides
            'name' => 'Iced Coffee',
            'description' => 'Café glacé rafraîchissant',
            'image' => 'iced_coffee.jpg',
            'price' => 3000,
            'stock' => 50,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 3, // Pâtisseries
            'name' => 'Croissant',
            'description' => 'Croissant au beurre frais',
            'image' => 'croissant.jpg',
            'price' => 1500,
            'stock' => 30,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 1, // Boissons chaudes
            'name' => 'Cappuccino',
            'description' => 'Cappuccino onctueux avec une belle mousse de lait',
            'image' => 'cappuccino.jpg',
            'price' => 3200, // En centimes
            'stock' => 90,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Mocha',
            'description' => 'Espresso mêlé à du chocolat chaud et lait crémeux',
            'image' => 'mocha.jpg',
            'price' => 3800,
            'stock' => 70,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Americano',
            'description' => 'Espresso allongé avec de l\'eau chaude pour un goût plus léger',
            'image' => 'americano.jpg',
            'price' => 2700,
            'stock' => 80,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 2, // Boissons froides
            'name' => 'Iced Latte',
            'description' => 'Version glacée du latte, parfait pour l\'été',
            'image' => 'iced_latte.jpg',
            'price' => 3300,
            'stock' => 60,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Thé glacé',
            'description' => 'Thé glacé citronné, rafraîchissant et léger',
            'image' => 'the_glace.jpg',
            'price' => 2500,
            'stock' => 65,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Smoothie aux fruits',
            'description' => 'Smoothie vitaminé avec un mélange de fruits frais',
            'image' => 'smoothie.jpg',
            'price' => 4000,
            'stock' => 40,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 3, // Pâtisseries
            'name' => 'Pain au chocolat',
            'description' => 'Délicieux pain au chocolat, idéal pour commencer la journée',
            'image' => 'pain_au_chocolat.jpg',
            'price' => 1800,
            'stock' => 50,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 3,
            'name' => 'Muffin aux myrtilles',
            'description' => 'Muffin moelleux aux myrtilles, parfait pour une pause sucrée',
            'image' => 'muffin.jpg',
            'price' => 2000,
            'stock' => 35,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 3,
            'name' => 'Tartelette aux fruits',
            'description' => 'Tartelette fine garnie de fruits de saison',
            'image' => 'tartelette.jpg',
            'price' => 3200,
            'stock' => 30,
            'is_available' => 1,
        ]);
        \App\Models\Product::create([
            'category_id' => 3,
            'name' => 'Éclair au chocolat',
            'description' => 'Éclair léger garni d\'une crème au chocolat',
            'image' => 'eclair.jpg',
            'price' => 3500,
            'stock' => 25,
            'is_available' => 1,
        ]);
    }
}