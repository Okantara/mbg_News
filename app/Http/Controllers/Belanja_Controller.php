<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Belanja;

class Belanja_Controller extends Controller
{
    public function index()
    {
        $belanja = Belanja::orderBy('tanggal', 'desc')->get();
        $total = $belanja->sum('total_belanja');
        
        return view('Biaya_Bahan', compact('belanja', 'total'));
    }

    public function create()
    {
        return view('Biaya_Bahan', ['belanja' => collect(), 'total' => 0, 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'supplier' => 'required',
            'pengeluaran_belanja' => 'required',
            'total_belanja' => 'required'
        ]);

        Belanja::create([
            'user_id' => auth()->id() ?? 1,
            'tanggal' => $request->tanggal,
            'supplier' => $request->supplier,
            'pengeluaran_belanja' => $request->pengeluaran_belanja,
            'total_belanja' => str_replace('.', '', $request->total_belanja),
        ]);

        return redirect()->route('belanja.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Belanja::findOrFail($id);
        $belanja = collect([$data]);
        $total = 0;
        
        return view('Biaya_Bahan', compact('belanja', 'total', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'supplier' => 'required',
            'pengeluaran_belanja' => 'required',
            'total_belanja' => 'required'
        ]);

        $belanja = Belanja::findOrFail($id);

        $belanja->update([
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'supplier' => $request->supplier,
            'pengeluaran_belanja' => $request->pengeluaran_belanja,
            'total_belanja' => str_replace('.', '', $request->total_belanja),
        ]);

        return redirect()->route('belanja.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Belanja::findOrFail($id)->delete();
        return redirect()->route('belanja.index')->with('success', 'Data berhasil dihapus');
    }
}
