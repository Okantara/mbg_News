<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kategori;
use Carbon\Carbon;

class PrintToPdf extends Controller
{
    public function rekapMenuPdf(Request $request)
    {
        $data = app(Rekap_Menu_Controller::class)->getRekapData($request);

        $kategoriOrder = Kategori::orderBy('nama_kategori')
            ->pluck('nama_kategori');

        $pdf = Pdf::loadView('pdf.rekap_menu', compact('data', 'kategoriOrder'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('rekap-menu.pdf');
    }

    public function rekapOmprengPdf(Request $request)
    {
        $dataResult = app(Rekap_Ompreng_Controller::class)->getData($request);

        $data = $dataResult['data'];
        $kategoriList = $dataResult['kategoriList'];

        // ambil tanggal (pakai hari ini kalau tidak ada filter)
        $tanggal = Carbon::now()->format('Y-m-d');

        $fileName = "data-ompreng.pdf";

        $pdf = Pdf::loadView('pdf.rekap_ompreng', compact('data', 'kategoriList'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream($fileName);
    }
}