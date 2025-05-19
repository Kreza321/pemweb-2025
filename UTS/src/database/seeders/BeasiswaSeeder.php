<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Beasiswa;
use Illuminate\Database\Seeder;

class BeasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Beasiswa::create([
            'nama' => 'Beasiswa Unggulan',
            'deskripsi' => 'Beasiswa untuk mahasiswa berprestasi',
            'kuota' => 10,
            'deadline' => '2024-12-31',
            'persyaratan' => 'IPK minimal 3.5, aktif berorganisasi',
        ]);
    }
}
