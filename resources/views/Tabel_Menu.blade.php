@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')
<main class="container mx-auto mt-10 px-4 pt-16">

    <!-- Page Title -->
    <h1 class="text-3xl font-bold text-center mb-8">
        Table Menu Rekap Menu
    </h1>

    <!-- Filter Controls -->
    <form method="GET" action="{{ route('rekap.menu') }}"
        class="flex flex-wrap items-end gap-4 mb-8 justify-start">

        <!-- Start Date -->
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
            <input type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="border border-gray-300 rounded-md px-4 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- End Date -->
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Akhir</label>
            <input type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="border border-gray-300 rounded-md px-4 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-5 py-2 rounded-md transition">
                Filter
            </button>

            <button type="button"
                onclick="window.print()"
                class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-5 py-2 rounded-md transition">
                Print
            </button>
        </div>

    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border-collapse">

            <!-- Head -->
            <thead class="bg-gray-100 text-gray-700 text-base uppercase">
                <tr>
                    <th class="px-4 py-3">Hari, Tanggal</th>
                    <th class="px-4 py-3">Karbohidrat</th>
                    <th class="px-4 py-3">Hewani</th>
                    <th class="px-4 py-3">Nabati</th>
                    <th class="px-4 py-3">Sayuran</th>
                    <th class="px-4 py-3">Buah / Minuman</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-gray-800 text-base divide-y divide-gray-200">
                @foreach($data as $row)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        {{ $row['hari'] }},
                        {{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3">{{ $row['karbo'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $row['hewani'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $row['nabati'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $row['sayuran'] }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $row['buah'] }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</main>
@endsection