<?php

namespace App\Http\Controllers;

use App\Models\Ompreng;
use App\Models\Kategori;
use Illuminate\Http\Request;

class OmprengViewController extends Controller
{
    // Tampilkan semua ompreng beserta kategori
    public function index()
    {
        $ompreng = Ompreng::all();
        $kategori = Kategori::all();

        return view('Input_Kategori_Ompreng', compact('ompreng', 'kategori'));
    }

    // Simpan ompreng baru
    public function store(Request $request)
    {
        $request->validate([
            'Kategori_penerima' => 'required|string|max:255'
        ]);

        Ompreng::create([
            'user_id' => auth()->id() ?? 1,
            'Kategori_penerima' => $request->Kategori_penerima
        ]);

        return redirect()->back()->with('success', 'Ompreng berhasil ditambahkan');
    }

    // Update ompreng
    public function update(Request $request, $id)
    {
        $request->validate([
            'Kategori_penerima' => 'required|string|max:255'
        ]);

        $ompreng = Ompreng::findOrFail($id);

        $ompreng->update([
            'Kategori_penerima' => $request->Kategori_penerima
        ]);

        return redirect()->back()->with('success', 'Ompreng berhasil diupdate');
    }

    // Hapus ompreng
    public function destroy($id)
    {
        $ompreng = Ompreng::findOrFail($id);
        $ompreng->delete();

        return redirect()->back()->with('success', 'Ompreng berhasil dihapus');
    }
}