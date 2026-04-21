<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use Carbon\Carbon;

class Rekap_Menu_Controller extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        // 🔥 kategori dari database
        $kategoriOrder = Kategori::orderBy('id')
            ->pluck('nama_kategori')
            ->toArray();

        $kategoriDefault = array_fill_keys($kategoriOrder, '-');

        // 🔥 ambil menu hanya yang status APPROVED
        $menus = Menu::with(['items.kategori'])
            ->where('status', 'approved') // 👈 INI TAMBAHANNYA
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereHas('items', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('menu_detail.created_at', [$startDate, $endDate]);
                });
            })
            ->when($startDate && !$endDate, function ($q) use ($startDate) {
                $q->whereHas('items', function ($q) use ($startDate) {
                    $q->whereDate('menu_detail.created_at', '>=', $startDate);
                });
            })
            ->when(!$startDate && $endDate, function ($q) use ($endDate) {
                $q->whereHas('items', function ($q) use ($endDate) {
                    $q->whereDate('menu_detail.created_at', '<=', $endDate);
                });
            })
            ->get();

        // 🔥 flatten
        $rows = collect();

foreach ($menus as $menu) {
    foreach ($menu->items as $item) {

        $kategori = $item->kategori->nama_kategori ?? null;
        if (!$kategori) continue;

        // 🔥 FIX: pakai tanggal menu, bukan pivot
        $date = Carbon::parse($menu->tanggal);

        $rows->push([
            'tanggal'  => $date->format('Y-m-d'),
            'kategori' => $kategori,
            'item'     => $item->nama_item,
        ]);
    }
}

        // 🔥 pivot
        $data = $rows->groupBy('tanggal')->map(function ($items, $date) use ($kategoriDefault) {

            $result = array_merge([
                'hari_tanggal' => Carbon::parse($date)->translatedFormat('l, d/m/Y'),
            ], $kategoriDefault);

            foreach ($items as $item) {
                $kategori = $item['kategori'];

                if (isset($result[$kategori])) {
                    $result[$kategori] = $result[$kategori] === '-'
                        ? $item['item']
                        : $result[$kategori] . ', ' . $item['item'];
                }
            }

            return $result;
        })->values();

        return view('Tabel_Menu', compact('data', 'kategoriOrder'));
    }

    // Rekap Data
    public function getRekapData(Request $request)
{
    Carbon::setLocale('id');

    $startDate = $request->start_date;
    $endDate   = $request->end_date;

    $kategoriOrder = Kategori::orderBy('id')
        ->pluck('nama_kategori')
        ->toArray();

    $kategoriDefault = array_fill_keys($kategoriOrder, '-');

    $menus = Menu::with(['items.kategori'])
        ->where('status', 'approved')
        ->get();

    $rows = collect();

    foreach ($menus as $menu) {
        foreach ($menu->items as $item) {

            $kategori = $item->kategori->nama_kategori ?? null;
            if (!$kategori) continue;

            $date = Carbon::parse($menu->tanggal);

            $rows->push([
                'tanggal'  => $date->format('Y-m-d'),
                'kategori' => $kategori,
                'item'     => $item->nama_item,
            ]);
        }
    }

    $data = $rows->groupBy('tanggal')->map(function ($items, $date) use ($kategoriDefault) {

        $result = array_merge([
            'hari_tanggal' => Carbon::parse($date)->translatedFormat('l, d/m/Y'),
        ], $kategoriDefault);

        foreach ($items as $item) {
            $kategori = $item['kategori'];

            if (isset($result[$kategori])) {
                $result[$kategori] = $result[$kategori] === '-'
                    ? $item['item']
                    : $result[$kategori] . ', ' . $item['item'];
            }
        }

        return $result;
    })->values();

    return $data;
}
}