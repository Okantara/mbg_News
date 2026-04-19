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
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OmprengController;
use App\Http\Controllers\OmprengViewController;
use App\Http\Controllers\MenuViewController;
use App\Http\Controllers\MenuOmprengController;

use App\Http\Controllers\Rekap_Menu_Controller;
use App\Http\Controllers\Rekap_Ompreng_Controller;

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('Home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// route untuk halaman biaya bahan (belanja)
Route::resource('belanja', Belanja_Controller::class);

// route untuk halaman rekap belanja
Route::get('/rekap-belanja', [Rekap_Belanja_controller::class, 'index'])->name('rekap_belanja');

// route untuk halaman operasional
Route::resource('operasional', Operasional_Controller::class);

// route untuk halaman rekap operasional
Route::get('/Rekap_Operasional_Controller', [Rekap_Operasional_Controller::class, 'index'])
    ->name('rekap.operasional');

// route untuk halaman manajemen pengguna
Route::get('/password', [MenuUsers_Controller::class, 'index'])->name('users.index');
Route::put('/password/{id}', [MenuUsers_Controller::class, 'update'])->name('users.update');

// route untuk halaman kategori dan ompreng
Route::get('/kategori-ompreng', [OmprengViewController::class, 'index'])->name('kategori.index');
Route::post('/kategori/store', [Kategori_Ompreng_Controller::class, 'store'])->name('kategori.store');
Route::put('/kategori/{id}', [Kategori_Ompreng_Controller::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [Kategori_Ompreng_Controller::class, 'destroy'])->name('kategori.destroy');

Route::post('/ompreng/store', [OmprengViewController::class, 'store'])->name('ompreng.store');
Route::put('/ompreng/{id}', [OmprengViewController::class, 'update'])->name('ompreng.update');
Route::delete('/ompreng/{id}', [OmprengViewController::class, 'destroy'])->name('ompreng.destroy');

// route untuk halaman menu (view)
Route::get('/menu', [MenuViewController::class, 'index'])->name('menu.index');
Route::post('/menu/store', [MenuViewController::class, 'store'])->name('menu.store');
Route::delete('/menu/{id}', [MenuViewController::class, 'destroy'])->name('menu.destroy');
Route::patch('/menu/{id}/tayang', [MenuViewController::class, 'tayang'])->name('menu.tayang');

// route untuk halaman item menu
Route::get('/item-menu', [Item_Controllers::class, 'index'])->name('item.index');
Route::post('/item-menu/store', [Item_Controllers::class, 'store'])->name('item.store');
Route::delete('/item-menu/{id}', [Item_Controllers::class, 'destroy'])->name('item.destroy');

Route::apiResource('menus', MenuController::class);
Route::apiResource('ompreng', OmprengController::class);

Route::post('menus/{id}/attach-ompreng', [MenuOmprengController::class, 'attachOmpreng']);
Route::delete('menus/{menuId}/detach-ompreng/{omprengId}', [MenuOmprengController::class, 'detachOmpreng']);

// route untuk halaman rekap menu
Route::get('/rekap-menu', [Rekap_Menu_Controller::class, 'index'])
    ->name('rekap.menu');

// route untuk halaman rekap ompreng
Route::get('/rekap-ompreng', [Rekap_Ompreng_Controller::class, 'index'])->name('rekap.ompreng');