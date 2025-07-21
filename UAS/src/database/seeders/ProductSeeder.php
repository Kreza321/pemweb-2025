<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first(); // gunakan kategori pertama sebagai default

        Product::create([
            'name' => 'Hydrating Facial Cleanser',
            'description' => 'Pembersih wajah dengan formula ringan dan melembapkan.',
            'price' => 89000,
            'stock' => 50,
            'category_id' => $category->id,
            'brand' => 'SkincarePro',
            'ingredients' => 'Aloe Vera, Glycerin, Niacinamide',
            'skin_type' => 'Normal to Dry',
            'size' => '100ml',
            'image' => 'cleanser.jpg',
        ]);
    }
}
