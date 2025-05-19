<?php

namespace Database\Seeders;

use App\Models\pageconfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageconfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        pageconfig::create([
            'tittle' => 'YOU',
            'detail' => 'The Best ',
            'image' => '',
        ]);
    }
}
