<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Cleanser', 'price' => 30000],
            ['name' => 'Toner', 'price' => 40000],
            ['name' => 'Serum', 'price' => 60000],
            ['name' => 'Moisturizer', 'price' => 55000],
            ['name' => 'Sunscreen', 'price' => 50000],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
