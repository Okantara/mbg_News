@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')
<main class="container mx-auto mt-10 px-4 pt-16">

    <h1 class="text-3xl font-bold text-center mb-8">
        Table Menu Rekap Menu
    </h1>

    <!-- FILTER -->
    <form method="GET" action="{{ route('rekap.menu') }}"
        class="flex flex-wrap items-end gap-4 mb-8">

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
            <input type="date" name="start_date"
                value="{{ request('start_date') }}"
                class="border rounded px-4 py-2 w-48">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Akhir</label>
            <input type="date" name="end_date"
                value="{{ request('end_date') }}"
                class="border rounded px-4 py-2 w-48">
        </div>

        <div class="flex gap-2">
            <button type="submit"
                class="bg-yellow-400 px-5 py-2 rounded">
                Filter
            </button>

            <button type="button"
                onclick="window.print()"
                class="bg-gray-800 text-white px-5 py-2 rounded">
                Print
            </button>
        </div>

    </form>

    <!-- TABLE -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">

        <table class="w-full text-left border-collapse">

            <!-- HEADER -->
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-3">Hari, Tanggal</th>

                    @foreach($kategoriOrder as $kategori)
                        <th class="px-4 py-3">
                            {{ $kategori }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="text-gray-800 divide-y">

                @forelse($data as $row)
                <tr>

                    <td class="px-4 py-3">
                        {{ $row['hari_tanggal'] ?? '-' }}
                    </td>

                    @foreach($kategoriOrder as $kategori)
                        <td class="px-4 py-3">
                            {{ $row[$kategori] ?? '-' }}
                        </td>
                    @endforeach

                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($kategoriOrder) + 1 }}"
                        class="text-center py-6 text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</main>
@endsection