<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Belanja_Controller;
use App\Http\Controllers\Rekap_Belanja_controller;
use App\Http\Controllers\Rekap_Operasional_Controller;
use App\Http\Controllers\Operasional_Controller;
use App\Http\Controllers\MenuUsers_Controller;
use App\Http\Controllers\Kategori_Ompreng_Controller;
use App\Http\Controllers\Item_Controllers;
use App\Http\Controllers\OmprengController;
use App\Http\Controllers\OmprengViewController;
use App\Http\Controllers\MenuViewController;
use App\Http\Controllers\MenuOmprengController;
use App\Http\Controllers\Rekap_Menu_Controller;
use App\Http\Controllers\Rekap_Ompreng_Controller;
use App\Http\Controllers\PrintToPdf;

use App\Http\Controllers\MenuController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/login');
});

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('Home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ============ ROUTES DENGAN PERMISSION CHECK ============

// 1. HALAMAN BIAYA BELANJA (Isi Biaya Belanja)
Route::middleware(['auth', 'checkPagePermission:Isi Biaya Belanja'])->group(function () {
    Route::resource('belanja', Belanja_Controller::class);
});

// 2. HALAMAN REKAP BIAYA BELANJA (Tabel Biaya Belanja)
Route::get('/rekap-belanja', [Rekap_Belanja_controller::class, 'index'])
    ->middleware(['auth', 'checkPagePermission:Tabel Biaya Belanja'])
    ->name('rekap_belanja');

// 3. HALAMAN OPERASIONAL (Isi Operasional)
Route::middleware(['auth', 'checkPagePermission:Isi Operasional'])->group(function () {
    Route::resource('operasional', Operasional_Controller::class);
});

// 4. HALAMAN REKAP OPERASIONAL (Tabel Operasional)
Route::get('/Rekap_Operasional_Controller', [Rekap_Operasional_Controller::class, 'index'])
    ->middleware(['auth', 'checkPagePermission:Tabel Operasional'])
    ->name('rekap.operasional');

// 5. HALAMAN MANAJEMEN PENGGUNA - ADMIN ONLY (Password)
Route::middleware(['auth', 'checkPagePermission:Password'])->group(function () {
    Route::get('/password', [MenuUsers_Controller::class, 'index'])->name('users.index');
    Route::put('/password/{id}', [MenuUsers_Controller::class, 'update'])->name('users.update');
    Route::put('/password/{id}/role', [MenuUsers_Controller::class, 'updateRole'])->name('users.updateRole');
    Route::put('/password/{id}/permissions', [MenuUsers_Controller::class, 'updatePermissions'])->name('users.updatePermissions');
    Route::post('/password/role-permissions', [MenuUsers_Controller::class, 'updateRolePermissions'])->name('users.updateRolePermissions');
});

// 6. HALAMAN KATEGORI DAN OMPRENG (Isi Kategori)
Route::middleware(['auth', 'checkPagePermission:Isi Kategori'])->group(function () {
    Route::get('/kategori-ompreng', [OmprengViewController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/store', [Kategori_Ompreng_Controller::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [Kategori_Ompreng_Controller::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [Kategori_Ompreng_Controller::class, 'destroy'])->name('kategori.destroy');

    Route::post('/ompreng/store', [OmprengViewController::class, 'store'])->name('ompreng.store');
    Route::put('/ompreng/{id}', [OmprengViewController::class, 'update'])->name('ompreng.update');
    Route::delete('/ompreng/{id}', [OmprengViewController::class, 'destroy'])->name('ompreng.destroy');

    Route::get('/item-menu', [Item_Controllers::class, 'index'])->name('item.index');
    Route::post('/item-menu/store', [Item_Controllers::class, 'store'])->name('item.store');
    Route::delete('/item-menu/{id}', [Item_Controllers::class, 'destroy'])->name('item.destroy');
});

// 7. HALAMAN MENU (Isi Menu MBG)
Route::middleware(['auth', 'checkPagePermission:Isi Menu MBG'])->group(function () {
    Route::get('/menu', [MenuViewController::class, 'index'])->name('menu.index');
    Route::post('/menu/store', [MenuViewController::class, 'store'])->name('menu.store');
    Route::delete('/menu/{id}', [MenuViewController::class, 'destroy'])->name('menu.destroy');
    Route::patch('/menu/{id}/tayang', [MenuViewController::class, 'tayang'])->name('menu.tayang');
    Route::delete('/menu/{id}/soft', [MenuViewController::class, 'deleteview'])->name('menu.delete');
});

// 8. HALAMAN REKAP MENU (Tabel Rekap Menu)
Route::get('/rekap-menu', [Rekap_Menu_Controller::class, 'index'])
    ->middleware(['auth', 'checkPagePermission:Tabel Rekap Menu'])
    ->name('rekap.menu');

// 9. HALAMAN REKAP OMPRENG (Tabel Rekap Ompreng)
Route::get('/rekap-ompreng', [Rekap_Ompreng_Controller::class, 'index'])
    ->middleware(['auth', 'checkPagePermission:Tabel Rekap Ompreng'])
    ->name('rekap.ompreng');

// 10. API ROUTES (LESS RESTRICTED)
Route::middleware('auth')->group(function () {
    Route::apiResource('menus', MenuController::class);
    Route::apiResource('ompreng', OmprengController::class);
    
    Route::post('menus/{id}/attach-ompreng', [MenuOmprengController::class, 'attachOmpreng']);
    Route::delete('menus/{menuId}/detach-ompreng/{omprengId}', [MenuOmprengController::class, 'detachOmpreng']);
});

// print
Route::get('/rekap-menu/pdf', [PrintToPdf::class, 'rekapMenuPdf'])
    ->name('rekap.menu.pdf');
Route::get('/rekap-ompreng/pdf', [PrintToPdf::class, 'rekapOmprengPdf'])
    ->name('rekap.ompreng.pdf');