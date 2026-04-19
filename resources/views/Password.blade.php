@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')

<main class="p-10 pt-24">

    <!-- Title -->
    <section class="mb-10">
        <h1 class="text-4xl font-bold">Input Password</h1>
    </section>

    @php
        $permissions = [
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
            'Tampilan Layar'
        ];
    @endphp

    <!-- USERS LIST -->
    <section class="space-y-10 max-w-6xl">

        @foreach ($users as $user)
            <div class="space-y-4 border-b pb-6">

                <!-- ROLE + PASSWORD -->
                <div class="flex items-center space-x-8">

                    <div class="w-48 h-16 bg-custom-yellow border border-black flex items-center justify-center">
                        <span class="text-xl font-bold">
                            {{ $user->role }}
                        </span>
                    </div>

                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                        class="flex items-center space-x-4">
                        @csrf
                        @method('PUT')

                        <input type="password" name="password"
                            class="w-48 h-12 border border-black px-3 text-xs text-center"
                            placeholder="Password baru"
                            required>

                        <button type="submit"
                            class="text-lg font-bold underline hover:no-underline">
                            Ubah<br>Password
                        </button>
                    </form>

                </div>

                <!-- TABLE (selain admin) -->
                @if (strtolower($user->role) !== 'admin')
                    <div class="overflow-x-auto">
                        <table class="w-full border border-black text-xs">

                            <!-- HEADER -->
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2">Role</th>

                                    @foreach ($permissions as $perm)
                                        <th class="border p-2">{{ $perm }}</th>
                                    @endforeach
                                </tr>
                            </thead>

                            <!-- BODY -->
                            <tbody>
                                <tr>
                                    <td class="border p-2 text-center font-bold">
                                        {{ $user->role }}
                                    </td>

                                    @foreach ($permissions as $perm)
                                        <td class="border p-2 text-center">
                                            <input type="checkbox" name="permissions[{{ $user->id }}][]" value="{{ $perm }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>

                        </table>
                    </div>
                @endif

            </div>
        @endforeach

    </section>

</main>

@endsection