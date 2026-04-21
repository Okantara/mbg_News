<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenuUsers_Controller extends Controller
{
    protected $permissions = [
        'Password',
        'Isi Kategori',
        'Database',
        'Isi Menu MBG',
        'Tabel Rekap Menu',
        'Tabel Rekap Ompreng',
        'Isi Biaya Belanja',
        'Tabel Biaya Belanja',
        'Isi Operasional',
        'Tabel Operasional',
        'Tampilan Layar',
        'Asset'
    ];

    // TAMPILKAN DATA BERDASARKAN ROLE
    public function index()
    {
        $users = User::whereIn('role', [
            'admin',
            'keuangan',
            'relawan',
            'mbg'
        ])->get();

        $permissions = Permission::whereIn('name', $this->permissions)
            ->orderBy('name')
            ->get();

        $roles = Role::whereIn('name', ['admin', 'mbg', 'keuangan', 'relawan'])
            ->with('permissions')
            ->get();

        return view('password', compact('users', 'permissions', 'roles'));
    }

    // UPDATE PASSWORD
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Password berhasil diubah');
    }

    // UPDATE ROLE
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roleName = strtolower($request->input('role')); // Normalize to lowercase

        // Validate role exists
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return redirect()->route('users.index')
                ->with('error', 'Role tidak valid');
        }

        // Sync user role
        $user->syncRoles($role);
        $user->role = $roleName;
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Role berhasil diubah');
    }

    // UPDATE USER PERMISSIONS (Direct permissions, not through role)
    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $permissions = $request->input('permissions', []);
        $validPermissions = Permission::whereIn('name', $this->permissions)
            ->pluck('name')
            ->toArray();

        // Validate permissions
        $permissions = array_intersect($permissions, $validPermissions);

        // Sync user permissions (replace existing ones)
        $user->syncPermissions($permissions);

        return redirect()->route('users.index')
            ->with('success', 'Permission berhasil diubah');
    }

    // UPDATE ROLE PERMISSIONS (Only for Admin)
    public function updateRolePermissions(Request $request)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Hanya admin yang bisa mengubah role permission');
        }

        $roleName = strtolower($request->input('role')); // Normalize to lowercase
        $permissions = $request->input('permissions', []);

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return redirect()->route('users.index')
                ->with('error', 'Role tidak valid');
        }

        $validPermissions = Permission::whereIn('name', $this->permissions)
            ->pluck('name')
            ->toArray();

        // Validate permissions
        $permissions = array_intersect($permissions, $validPermissions);

        // Sync role permissions
        $role->syncPermissions($permissions);

        return redirect()->route('users.index')
            ->with('success', 'Permission role berhasil diubah');
    }
}

