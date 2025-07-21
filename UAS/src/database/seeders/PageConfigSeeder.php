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
        //
        PageConfig::create([
            'title' => 'Selamat Datang Di Pelaporan Jalan Rusak',
            'detail' => 'Mewujudkan Mimpi Untuk Lanjut Studi Keluar Negeri Dengan Beasiswa Di Kampus Top Dunia.',
            'image' => ''
        ]);
    }
}