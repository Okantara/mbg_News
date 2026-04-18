<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::with('omprengs')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'in:draft,approved',
            'catatan' => 'nullable',
        ]);

        return Menu::create($request->all());
    }

    public function show($id)
    {
        return Menu::with('omprengs')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return $menu;
    }

    public function destroy($id)
    {
        return Menu::destroy($id);
    }
}
