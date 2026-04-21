# User Permission System dengan Spatie

Sistem permission management yang memungkinkan admin untuk mengatur akses halaman per user atau per role.

## Fitur Utama

1. **Role Management**: Admin, MBG, Keuangan, Relawan
2. **Permission Management**: 12 halaman yang bisa dikontrol
3. **Two-Level Permission**:
    - Role Permission: Permission default untuk setiap role
    - Direct Permission: Permission individual per user (override role)

## Permissions (Halaman)

```
- Password
- Isi Kategori
- Database
- Isi Menu MBG
- Tabel Rekap Menu
- Tabel Rekap Ompreng
- Isi Biaya Belanja
- Tabel Biaya Belanja
- Isi Operasional
- Tabel Operasional
- Tampilan Layar
- Asset
```

## Setup

### 1. Jalankan Migration (sudah ada)

```bash
php artisan migrate
```

### 2. Jalankan Seeder

```bash
php artisan db:seed --class=RolePermissionSeeder
```

Atau jalankan semua seeder:

```bash
php artisan db:seed
```

## Cara Menggunakan

### A. Di Controller

```php
// Check permission untuk single action
if (auth()->user()->hasPermissionTo('Isi Biaya Belanja')) {
    // User bisa akses
}

// Check role
if (auth()->user()->hasRole('Admin')) {
    // Admin only
}

// Assign permission ke user
$user->givePermissionTo('Password');

// Revoke permission dari user
$user->revokePermissionTo('Password');
```

### B. Di Blade Template

```blade
<!-- Check permission -->
@can('Isi Biaya Belanja')
    <button>Edit Biaya</button>
@endcan

<!-- Check role -->
@role('Admin')
    <div>Admin Only Section</div>
@endrole

<!-- Check if doesn't have permission -->
@cannot('Password')
    <p>Anda tidak memiliki akses</p>
@endcannot
```

### C. Middleware untuk Route Protection

Di `routes/web.php`:

```php
// Protect halaman dengan middleware
Route::get('/belanja', [Belanja_Controller::class, 'index'])
    ->middleware('checkPagePermission:Isi Biaya Belanja');

// Atau untuk multiple permissions
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('permission:Tampilan Layar|Password');
```

### D. Langsung di Route (menggunakan Spatie built-in)

```php
Route::resource('belanja', Belanja_Controller::class)
    ->middleware('permission:Isi Biaya Belanja');
```

## Struktur Database

- `permissions` - Daftar semua permission
- `roles` - Daftar semua role
- `role_has_permissions` - Relasi role dan permission
- `model_has_permissions` - Relasi user dan permission (direct)
- `model_has_roles` - Relasi user dan role

## Admin Interface

Akses di `/password` untuk mengelola:

### Tab 1: User Management

- Ubah password user
- Ubah role user
- Set direct permission per user

### Tab 2: Role Permissions

- Set default permission untuk setiap role
- Berlaku untuk semua user dengan role tersebut

## Default Permission per Role

### Admin

- Semua permission

### MBG

- Isi Menu MBG
- Tabel Rekap Menu
- Tabel Rekap Ompreng
- Tampilan Layar

### Keuangan

- Isi Biaya Belanja
- Tabel Biaya Belanja
- Isi Operasional
- Tabel Operasional
- Tampilan Layar

### Relawan

- Tampilan Layar

## Customization

### Menambah Permission Baru

1. Update array `$permissions` di `RolePermissionSeeder.php`:

```php
$permissions = [
    'Password',
    'New Permission', // Tambah di sini
    ...
];
```

2. Jalankan ulang seeder:

```bash
php artisan migrate:refresh --seed
```

### Mengubah Default Role Permissions

Edit di `RolePermissionSeeder.php`, bagian role permission assignment:

```php
$mbg->syncPermissions([
    'Isi Menu MBG',
    'New Permission', // Tambah permission baru
    ...
]);
```

## Testing

Jalankan test:

```bash
php artisan test
```

## Troubleshooting

### Permission tidak terbaca

```bash
php artisan cache:clear
php artisan config:clear
```

### Database belum ter-setup

```bash
php artisan migrate
php artisan db:seed --class=RolePermissionSeeder
```

### User tidak bisa akses meskipun punya permission

- Cek apakah user ter-assign dengan role
- Cek apakah middleware di-apply dengan benar
- Cek cache dengan `php artisan cache:clear`
