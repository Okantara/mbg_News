<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuOmpreng;
use Carbon\Carbon;

class Rekap_Ompreng_Controller extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date;
        $end   = $request->end_date;

        // 1. Ambil data dengan relasi menu
        $query = MenuOmpreng::with(['menu']);

        if ($start && $end) {
            $query->whereHas('menu', function ($q) use ($start, $end) {
                $q->whereBetween('tanggal', [$start, $end]);
            });
        }

        $rawData = $query->get();

        // =========================
        // FIX 1: NORMALISASI KATEGORI (INI PENYEBAB 0)
        // =========================
        $kategoriList = $rawData->map(function ($item) {
            return strtolower(trim($item->kategori_penerima));
        })
        ->unique()
        ->filter()
        ->values();

        // =========================
        // FIX 2: GROUPING
        // =========================
        $data = $rawData->groupBy(function ($item) {
            return optional($item->menu)->tanggal ?? 'Tanpa Tanggal';
        })->map(function ($items, $tanggal) use ($kategoriList) {

            $row = [
                'hari_tanggal' => ($tanggal !== 'Tanpa Tanggal')
                    ? Carbon::parse($tanggal)->translatedFormat('d M Y')
                    : $tanggal,
                'total' => 0
            ];

            foreach ($kategoriList as $kat) {

                // FIX UTAMA: normalisasi compare
                $jumlah = $items->filter(function ($item) use ($kat) {
                    return strtolower(trim($item->kategori_penerima)) === $kat;
                })->sum('jumlah');

                $row[$kat] = (int) $jumlah;
                $row['total'] += (int) $jumlah;
            }

            return $row;
        })->values();

        return view('Tabel_Ompreng', [
            'data' => $data,
            'kategoriList' => $kategoriList,
        ]);
    }
}