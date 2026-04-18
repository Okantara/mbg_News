<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Item;

class Item_Controllers extends Controller
{
    // TAMPILKAN DATA
    public function index()
    {
        $kategori = Kategori::with('items')->get();

        return view('Data_Menu', compact('kategori'));
    }

    // TAMBAH ITEM
    public function store(Request $request)
    {
        $kategori = Kategori::find($request->kategori_id);

        Item::create([
            'kategori_nama' => $kategori->id,
            'nama_item' => $request->nama_item,
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan');
    }

    // HAPUS ITEM
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}