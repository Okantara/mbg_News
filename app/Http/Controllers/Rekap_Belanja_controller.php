<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use Illuminate\Http\Request;

class Rekap_Belanja_controller extends Controller
{
    // Tampilkan data + rekap (filter tanggal opsional)
    public function index(Request $request)
    {
        $query = Belanja::query();

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $belanja = $query->get();

        $total = $belanja->sum('total_belanja');

        return view('Tabel_Biaya', compact('belanja', 'total'));
    }
}
