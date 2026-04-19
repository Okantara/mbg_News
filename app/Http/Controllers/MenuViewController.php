<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Ompreng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuViewController extends Controller
{
    // Tampilkan form input menu dan daftar menu
    public function index(Request $request)
{
    $query = Menu::with('items', 'omprengs');

    if (!$request->has('all')) {
        $query->where('status', 'draft');
    }

    $menus = $query->get();

    $kategori = Kategori::with('items')->get();
    $ompreng = Ompreng::with('user')->get();

    return view('Input_Menu', compact('kategori', 'ompreng', 'menus'));
}

    // Simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        // 1. Buat menu baru
        $menu = Menu::create([
            'user_id' => auth()->id() ?? 1,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
            'status' => 'draft'
        ]);

        // 2. Simpan items
        if ($request->has('items')) {
            foreach ($request->items as $kategoriId => $itemId) {
                if ($itemId) {

                    $kategori = Kategori::find($kategoriId);
                    $item = \App\Models\Item::find($itemId);

                    DB::table('menu_detail')->insert([
                        'menu_id' => $menu->id,
                        'item_id' => $itemId,
                        'item_name' => $item->nama_item, // ✅ WAJIB
                        'kategori_name' => $kategori->nama_kategori,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

// 3. Simpan ompreng dengan jumlah
if ($request->has('ompreng_jumlah')) {
    foreach ($request->ompreng_jumlah as $omprengId => $jumlah) {
        if ($jumlah > 0) {

            $ompreng = Ompreng::find($omprengId);

            if ($ompreng) {
                DB::table('menu_ompreng')->insert([
                    'menu_id' => $menu->id,
                    'ompreng_id' => $omprengId,
                    'kategori_penerima' => $ompreng->Kategori_penerima, // ✅ FIX
                    'jumlah' => $jumlah,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

        return redirect()->back()->with('success', 'Menu berhasil disimpan');
    }

    // Hapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus');
    }

    // Update status menu ke tayang
    public function tayang(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Menu berhasil ditayangkan');
    }
}

