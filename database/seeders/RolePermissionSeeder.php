<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define permissions (halaman)
        $permissions = [
            'Password',
            'Isi Kategori',
            'Database',
            'Isi Menu MBG',
            'Tabel Rekap Menu',
            'Tabel Rekap Ompreng',
            'Isi Biaya Belanja',
            'Tabel Biaya Belanja',
            'Isi Operasional',
            'Tabel Operasional',
            'Tampilan Layar',
            'Asset'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles (use lowercase for consistency)
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $mbg = Role::firstOrCreate(['name' => 'mbg', 'guard_name' => 'web']);
        $keuangan = Role::firstOrCreate(['name' => 'keuangan', 'guard_name' => 'web']);
        $relawan = Role::firstOrCreate(['name' => 'relawan', 'guard_name' => 'web']);

        // Admin memiliki semua permissions
        $admin->syncPermissions(Permission::all());

        // MBG memiliki permission tertentu
        $mbg->syncPermissions([
            'Isi Menu MBG',
            'Tabel Rekap Menu',
            'Tabel Rekap Ompreng',
            'Tampilan Layar',
        ]);

        // Keuangan memiliki permission tertentu
        $keuangan->syncPermissions([
            'Isi Biaya Belanja',
            'Tabel Biaya Belanja',
            'Isi Operasional',
            'Tabel Operasional',
            'Tampilan Layar',
        ]);

        // Relawan memiliki permission terbatas
        $relawan->syncPermissions([
            'Tampilan Layar',
        ]);
    }
}
