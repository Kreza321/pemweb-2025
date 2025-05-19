<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageConfig;

class PageConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(PageConfig::count()==0){
            PageConfig::create([
                'title' => 'Welcome to Our Website',
                'detail' => 'We are glad to have you here. Explore our services and offerings.',
                'image' => '',
            ]);
        } 
    }
}

