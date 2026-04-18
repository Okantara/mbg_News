<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operasional;
use Illuminate\Support\Facades\Auth;

class Operasional_Controller extends Controller
{
    // Tampilkan halaman + data
    public function index()
    {
        $data = Operasional::latest()->get();

        // hitung total biaya
        $total = $data->sum('total_biaya');

        return view('biaya_operasional', compact('data', 'total'));
    }

    // Simpan data dari form
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'biaya_operasional' => 'required',
            'total_biaya' => 'required|numeric',
        ]);

        Operasional::create([
            'user_id' => Auth::id() ?? 1,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'biaya_operasional' => $request->biaya_operasional,
            'total_biaya' => $request->total_biaya,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = Operasional::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // Ambil data untuk edit (opsional kalau pakai modal)
    public function edit($id)
    {
        $data = Operasional::findOrFail($id);
        return response()->json($data);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'biaya_operasional' => 'required',
            'total_biaya' => 'required|numeric',
        ]);

        $data = Operasional::findOrFail($id);

        $data->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'biaya_operasional' => $request->biaya_operasional,
            'total_biaya' => $request->total_biaya,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
}
