@extends('layouts.app')

@section('title', 'Rekap Ompreng')

@section('content')

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-10">

    {{-- HEADER SECTION --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Rekap Kategori Penerima
            </h1>
            <p class="text-gray-500 text-sm mt-1">Laporan distribusi ompreng berdasarkan kategori dan tanggal.</p>
        </div>

        <div class="flex gap-2">
            <button type="button" 
                    onclick="window.print()" 
                    class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded shadow-sm text-sm font-medium inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    {{-- FILTER CARD --}}
    <div class="bg-white p-4 rounded-lg shadow-sm border mb-6 no-print">
        <form method="GET" action="{{ route('rekap.ompreng') }}" class="flex flex-wrap items-end gap-4">
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-600 uppercase">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="border rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-600 uppercase">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                       class="border rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition shadow-sm">
                Filter Data
            </button>
            
            @if(request('start_date'))
                <a href="{{ route('rekap.ompreng') }}" class="text-sm text-red-600 hover:underline mb-2">Reset</a>
            @endif
        </form>
    </div>

    {{-- TABLE SECTION --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
        <table class="min-w-full divide-y divide-gray-300 text-center">
            
            {{-- THEAD --}}
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900 border-b border-r">
                        Tanggal
                    </th>
                    @foreach($kategoriList as $kategori)
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900 border-b border-r uppercase tracking-wider">
                            {{ $kategori }}
                        </th>
                    @endforeach
                    <th scope="col" class="px-3 py-3.5 text-sm font-bold text-blue-900 border-b bg-blue-50">
                        TOTAL
                    </th>
                </tr>
            </thead>

            {{-- TBODY --}}
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 border-r">
                            {{ $row['hari_tanggal'] }}
                        </td>

                        @foreach($kategoriList as $kategori)
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600 border-r">
                                {{ number_format($row[$kategori] ?? 0, 0, ',', '.') }}
                            </td>
                        @endforeach

                        <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-gray-900 bg-blue-50/30">
                            {{ number_format($row['total'] ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($kategoriList) + 2 }}" class="px-3 py-10 text-sm text-gray-500 italic">
                            Data tidak ditemukan untuk periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            {{-- TFOOT --}}
            @if($data->isNotEmpty())
            <tfoot class="bg-gray-100 font-bold border-t-2 border-gray-300">
                <tr>
                    <td class="px-3 py-4 text-sm text-gray-900 text-left border-r uppercase">
                        Total Keseluruhan
                    </td>
                    
                    @foreach($kategoriList as $kategori)
                        <td class="px-3 py-4 text-sm text-gray-900 border-r">
                            {{ number_format($data->sum($kategori), 0, ',', '.') }}
                        </td>
                    @endforeach

                    <td class="px-3 py-4 text-sm text-blue-700 bg-blue-100">
                        {{ number_format($data->sum('total'), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
            @endif

        </table>
    </div>

    {{-- PRINT FOOTER (Hanya muncul saat di-print) --}}
    <div class="hidden print:block mt-10 text-right text-sm text-gray-500">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>

</main>

<style>
    @media print {
        .no-print { display: none !important; }
        body { background-color: white !important; }
        main { padding-top: 0 !important; }
    }
</style>

@endsection