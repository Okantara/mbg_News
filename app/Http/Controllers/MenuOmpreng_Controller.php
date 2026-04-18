<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Ompreng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuOmprengController extends Controller
{
    /**
     * SIMPAN SNAPSHOT OMPRENG
     */
    public function store(Request $request, $menuId)
    {
        $request->validate([
            'ompreng_id' => 'required|exists:ompreng,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($menuId);
        $ompreng = Ompreng::findOrFail($request->ompreng_id);

        DB::table('menu_ompreng')->insert([
            'menu_id' => $menu->id,
            'kategori_penerima' => $ompreng->Kategori_penerima, // snapshot
            'jumlah' => $request->jumlah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Ompreng berhasil disimpan');
    }

    /**
     * HAPUS SNAPSHOT
     */
    public function destroy($id)
    {
        DB::table('menu_ompreng')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Ompreng berhasil dihapus');
    }
}