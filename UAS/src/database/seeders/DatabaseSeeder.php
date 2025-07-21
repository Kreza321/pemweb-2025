<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
        RoleSeeder::class,
    ]);
        // Buat user admin
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole('super_admin');

        // Jalankan seeder lainnya
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            PageConfigSeeder::class,
            FooterSeeder::class,
            LogoSeeder::class,
        ]);
    }
}