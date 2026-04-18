<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Ompreng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['items', 'user'])
            ->where('status', 'draft')   // 👈 ini kuncinya
            ->latest()
            ->get();

        $kategori = Kategori::with('items')->get();
        $ompreng = Ompreng::all();

        return view('Input_Menu', compact('menus', 'kategori', 'ompreng'));
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'nullable',
        ]);

        // 1. SIMPAN MENU
        $menu = Menu::create([
            'user_id' => auth()->id() ?? 1,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
            'status' => 'draft'
        ]);

        // 2. SIMPAN ITEM KATEGORI
        if ($request->has('ompreng_jumlah')) {
            foreach ($request->ompreng_jumlah as $omprengId => $jumlah) {
                if ($jumlah > 0) {

                    $ompreng = Ompreng::find($omprengId);

                    if ($ompreng) {
                        DB::table('menu_ompreng')->insert([
                            'menu_id' => $menu->id,
                            'kategori_penerima' => $ompreng->kategori_penerima,
                            'jumlah' => $jumlah,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        // 3. SIMPAN OMPRENG DENGAN JUMLAH
        if ($request->has('ompreng_jumlah')) {
    foreach ($request->ompreng_jumlah as $omprengId => $jumlah) {
        if ($jumlah > 0) {

            $ompreng = Ompreng::find($omprengId);

            if ($ompreng) {
                DB::table('menu_ompreng')->insert([
                    'menu_id' => $menu->id,
                    'kategori_penerima' => $ompreng->Kategori_penerima, // WAJIB
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

    public function show($id)
    {
        return Menu::findOrFail($id);
    }

        public function tayang($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditayangkan');
    }
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus');
    }
}