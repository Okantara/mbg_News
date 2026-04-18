<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuOmprengController extends Controller
{
    public function attachOmpreng(Request $request, $menuId)
    {
        $request->validate([
            'ompreng_id' => 'required|exists:ompreng,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($menuId);

        $menu->omprengs()->attach($request->ompreng_id, [
            'jumlah' => $request->jumlah
        ]);

        return response()->json([
            'message' => 'Ompreng attached successfully'
        ]);
    }

    public function detachOmpreng($menuId, $omprengId)
    {
        $menu = Menu::findOrFail($menuId);

        $menu->omprengs()->detach($omprengId);

        return response()->json([
            'message' => 'Ompreng detached successfully'
        ]);
    }
}
