@extends('layouts.app')

@section('title', 'MBG || User Management')

@section('content')

<main class="p-10 pt-24">

    <!-- Title -->
    <section class="mb-10">
        <h1 class="text-4xl font-bold">Manajemen User & Permission</h1>
        <p class="text-gray-600 mt-2">Atur password, role, dan permission untuk setiap user</p>
    </section>

    <!-- Flash Messages -->
    @if ($message = Session::get('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ $message }}
        </div>
    @endif

    <!-- TABS -->
    <div class="mb-6 border-b border-gray-300">
        <div class="flex space-x-4">
            <button class="tab-btn active px-4 py-2 border-b-2 border-blue-500 text-blue-500 font-bold" data-tab="users-tab">
                User Management
            </button>
        </div>
    </div>

    <!-- TAB 1: USER MANAGEMENT -->
    <section id="users-tab" class="tab-content active space-y-10 max-w-7xl">

        @forelse ($users as $user)
            <div class="space-y-4 border-b pb-8 bg-gray-50 p-6 rounded">

                <!-- USER INFO HEADER -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-32 h-12 bg-custom-yellow border-2 border-black flex items-center justify-center">
                            <span class="text-lg font-bold">{{ $user->name }}</span>
                        </div>
                        <div class="text-lg font-semibold text-gray-700">
                            Role: <span class="text-blue-600">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- PASSWORD SECTION -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="password" 
                                class="w-full h-10 border border-gray-300 rounded px-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Kosongkan jika tidak ingin ubah">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <select name="role" class="w-full h-10 border border-gray-300 rounded px-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="admin" {{ strtolower($user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="mbg" {{ strtolower($user->role) === 'mbg' ? 'selected' : '' }}>MBG</option>
                                <option value="keuangan" {{ strtolower($user->role) === 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="relawan" {{ strtolower($user->role) === 'relawan' ? 'selected' : '' }}>Relawan</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full h-10 bg-blue-500 text-white font-bold rounded hover:bg-blue-600 transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

                <!-- DIRECT PERMISSIONS (for individual user) -->
                <div class="mt-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Direct Permission (Per Halaman)</h4>
                    <form action="{{ route('users.updatePermissions', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-300 text-sm">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="border border-gray-300 p-3 text-left font-bold">Halaman</th>
                                        <th class="border border-gray-300 p-3 text-center font-bold">Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $perm)
                                        <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                            <td class="border border-gray-300 p-3">{{ $perm->name }}</td>
                                            <td class="border border-gray-300 p-3 text-center">
                                                <input type="checkbox" name="permissions[]" 
                                                    value="{{ $perm->name }}"
                                                    {{ $user->hasPermissionTo($perm->name) ? 'checked' : '' }}
                                                    class="w-5 h-5 cursor-pointer">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-600 transition">
                                Simpan Permission
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        @empty
            <div class="text-center text-gray-500 py-10">
                Tidak ada user yang ditemukan
            </div>
        @endforelse

    </section>

    <!-- TAB 2: ROLE PERMISSIONS -->
    <!-- <section id="roles-tab" class="tab-content hidden space-y-10 max-w-7xl">

        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded mb-6">
            <p class="text-yellow-800">
                <strong>Catatan:</strong> Setting permission di sini akan berlaku untuk semua user dengan role tersebut. 
                User juga bisa memiliki permission tambahan secara individual.
            </p>
        </div>

        @foreach ($roles as $role)
            <div class="space-y-4 border-b pb-8 bg-gray-50 p-6 rounded"> -->

                <!-- ROLE HEADER -->
                <!-- <div class="flex items-center space-x-4 mb-6">
                    <div class="w-40 h-12 bg-custom-yellow border-2 border-black flex items-center justify-center">
                        <span class="text-lg font-bold">{{ ucfirst($role->name) }}</span>
                    </div>
                    <span class="text-sm text-gray-600">
                        ({{ $role->users_count ?? 0 }} user)
                    </span>
                </div> -->

                <!-- ROLE PERMISSIONS TABLE -->
                <!-- <form action="{{ route('users.updateRolePermissions') }}" method="POST">
                    @csrf

                    <input type="hidden" name="role" value="{{ $role->name }}">

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300 text-sm">
                            <thead class="bg-purple-100">
                                <tr>
                                    <th class="border border-gray-300 p-3 text-left font-bold">Halaman</th>
                                    <th class="border border-gray-300 p-3 text-center font-bold">Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $perm)
                                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                        <td class="border border-gray-300 p-3">{{ $perm->name }}</td>
                                        <td class="border border-gray-300 p-3 text-center">
                                            <input type="checkbox" name="permissions[]" 
                                                value="{{ $perm->name }}"
                                                {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}
                                                class="w-5 h-5 cursor-pointer">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-6 py-2 bg-purple-500 text-white font-bold rounded hover:bg-purple-600 transition">
                            Simpan Permission Role
                        </button>
                    </div>
                </form>

            </div>
        @endforeach

    </section> -->

</main>

<!-- Tab Script -->
<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active', 'border-blue-500', 'text-blue-500');
                b.classList.add('border-transparent', 'text-gray-600');
            });

            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
                tab.classList.remove('active');
            });

            // Add active class to clicked button
            this.classList.add('active', 'border-blue-500', 'text-blue-500');
            this.classList.remove('border-transparent', 'text-gray-600');

            // Show corresponding tab
            const tabId = this.getAttribute('data-tab');
            const tab = document.getElementById(tabId);
            tab.classList.remove('hidden');
            tab.classList.add('active');
        });
    });
</script>

@endsection