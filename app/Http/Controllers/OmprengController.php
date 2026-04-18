<?php

namespace App\Http\Controllers;

use App\Models\Ompreng;
use Illuminate\Http\Request;

class OmprengController extends Controller
{
    public function index()
    {
        return Ompreng::with('menus')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_pelanggan' => 'required|string|max:100',
        ]);

        return Ompreng::create($request->all());
    }

    public function show($id)
    {
        return Ompreng::with('menus')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $ompreng = Ompreng::findOrFail($id);
        $ompreng->update($request->all());

        return $ompreng;
    }

    public function destroy($id)
    {
        return Ompreng::destroy($id);
    }
}
