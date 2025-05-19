<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Roles (tidak akan duplikat)
        $this->call(RoleSeeder::class);

        // 2. Buat admin jika belum ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // Ganti di production!
                'email_verified_at' => now(),
            ]
        );
        
        // 3. Assign role (hanya jika belum punya role)
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }

        // 4. Seed data lain hanya jika tabel kosong
        if (\App\Models\Beasiswa::count() === 0) {
            $this->call([
                BeasiswaSeeder::class,
                PendaftarSeeder::class,
                PenerimaSeeder::class,
            ]);
        }
    }
}