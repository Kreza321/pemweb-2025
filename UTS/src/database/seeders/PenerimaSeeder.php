<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Penerima;
use Illuminate\Database\Seeder;

class PenerimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penerima::create([
            'pendaftar_id' => 1, // Sesuaikan dengan ID pendaftar
            'jumlah_dana' => 5000000,
            'tanggal_pencairan' => now()->addDays(30),
            'status_pencairan' => 'belum',
        ]);
    }
}
