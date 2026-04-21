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

        // 1. Ambil data + relasi menu
        $query = MenuOmpreng::with(['menu']);

        // 2. FILTER OPSIONAL (lebih aman pakai whereHas + whereDate)
        if ($start || $end) {
            $query->whereHas('menu', function ($q) use ($start, $end) {

                if ($start && $end) {
                    $q->whereDate('tanggal', '>=', $start)
                      ->whereDate('tanggal', '<=', $end);
                } elseif ($start) {
                    $q->whereDate('tanggal', '>=', $start);
                } elseif ($end) {
                    $q->whereDate('tanggal', '<=', $end);
                }

            });
        }

        $rawData = $query->get();

        // 3. Ambil kategori unik
        $kategoriList = $rawData->map(function ($item) {
                return strtolower(trim($item->kategori_penerima));
            })
            ->unique()
            ->filter()
            ->values();

        // 4. Grouping berdasarkan tanggal menu
        $data = $rawData->groupBy(function ($item) {
            return optional($item->menu)->tanggal;
        })
        ->filter() // buang null
        ->map(function ($items, $tanggal) use ($kategoriList) {

            $row = [
                'hari_tanggal' => Carbon::parse($tanggal)->translatedFormat('d M Y'),
                'total' => 0
            ];

            foreach ($kategoriList as $kat) {

                $jumlah = $items->filter(function ($item) use ($kat) {
                    return strtolower(trim($item->kategori_penerima)) === $kat;
                })->sum('jumlah');

                $row[$kat] = (int) $jumlah;
                $row['total'] += (int) $jumlah;
            }

            return $row;
        })
        ->values();

        // 5. View
        return view('Tabel_Ompreng', [
            'data' => $data,
            'kategoriList' => $kategoriList,
        ]);
    }

    public function getData(Request $request)
    {
        $start = $request->start_date;
        $end   = $request->end_date;

        $query = MenuOmpreng::with(['menu']);

        if ($start || $end) {
            $query->whereHas('menu', function ($q) use ($start, $end) {

                if ($start && $end) {
                    $q->whereDate('tanggal', '>=', $start)
                      ->whereDate('tanggal', '<=', $end);
                } elseif ($start) {
                    $q->whereDate('tanggal', '>=', $start);
                } elseif ($end) {
                    $q->whereDate('tanggal', '<=', $end);
                }

            });
        }

        $rawData = $query->get();

        // kategori unik
        $kategoriList = $rawData->map(function ($item) {
                return strtolower(trim($item->kategori_penerima));
            })
            ->unique()
            ->filter()
            ->values();

        // grouping per tanggal
        $data = $rawData->groupBy(function ($item) {
            return optional($item->menu)->tanggal;
        })
        ->filter()
        ->map(function ($items, $tanggal) use ($kategoriList) {

            $row = [
                'hari_tanggal' => Carbon::parse($tanggal)->translatedFormat('d M Y'),
                'total' => 0
            ];

            foreach ($kategoriList as $kat) {

                $jumlah = $items->filter(function ($item) use ($kat) {
                    return strtolower(trim($item->kategori_penerima)) === $kat;
                })->sum('jumlah');

                $row[$kat] = (int) $jumlah;
                $row['total'] += (int) $jumlah;
            }

            return $row;
        })
        ->values();

        return [
            'data' => $data,
            'kategoriList' => $kategoriList
        ];
    }
}