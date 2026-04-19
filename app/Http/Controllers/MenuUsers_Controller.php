<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MenuUsers_Controller extends Controller
{
    // TAMPILKAN DATA BERDASARKAN ROLE
    public function index()
    {
        $users = User::whereIn('role', [
            'Admin',
            'Keuangan',
            'Relawan',
            'MBG'
        ])->get();

        return view('password', compact('users'));
    }

    // UPDATE PASSWORD
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Password berhasil diubah');
    }
}
