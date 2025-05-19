<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pendaftar;
use Illuminate\Database\Seeder;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pendaftar::create([
            'user_id' => 1,
            'beasiswa_id' => 1,
            'nama_lengkap' => 'John Doe',
            'nim' => '123456789',
            'jurusan' => 'Teknik Informatika',
            'email' => 'john@example.com',
            'no_hp' => '08123456789',
            'berkas_khs' => 'khs_john.pdf',
            'berkas_ktp' => 'ktp_john.pdf',
            'status' => 'menunggu',
        ]);
    }
}
