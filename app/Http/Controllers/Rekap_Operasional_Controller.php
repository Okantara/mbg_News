<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operasional;

class Rekap_Operasional_Controller extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Operasional::query();

        // filter tanggal jika ada
        if ($start && $end) {
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $data = $query->orderBy('tanggal', 'asc')->get();

        $total = $data->sum('total_biaya');

        return view('Tabel_Operasional', compact('data', 'total', 'start', 'end'));
    }
}