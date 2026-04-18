<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuOmpreng;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with([
                'items',
                'user',
                'omprengs'
            ])
            ->where('status', 'approved')
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalOmpreng = MenuOmpreng::sum('jumlah');

        return view('Home', compact('menus', 'totalOmpreng'));
    }
}