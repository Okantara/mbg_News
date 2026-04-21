<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles dan permissions terlebih dahulu
        $this->call(RolePermissionSeeder::class);

        // User::factory(10)->create();

        $adminUser = User::factory()->create([
            'name' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Assign admin role ke user (lowercase karena Spatie normalisasi)
        $adminUser->assignRole('admin');
    }
}
