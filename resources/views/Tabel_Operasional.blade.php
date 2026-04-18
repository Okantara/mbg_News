@extends('layouts.app')

@section('title', 'MBG || Tabel Operasional')

@section('content')
    <!-- END: MainHeader -->
    <!-- BEGIN: FilterSection -->
    <main class="max-w-6xl mx-auto mt-20 px-4">

    <!-- FILTER -->
    <form action="{{ route('rekap.operasional') }}" method="GET"
          class="flex items-center gap-4 mb-12">

        <!-- Start Date -->
        <div class="border border-black p-1 px-2 flex items-center bg-white">
            <input
                type="date"
                name="start_date"
                value="{{ $start }}"
                class="border-none focus:ring-0 text-lg"
            >
        </div>

        <!-- End Date -->
        <div class="border border-black p-1 px-2 flex items-center bg-white">
            <input
                type="date"
                name="end_date"
                value="{{ $end }}"
                class="border-none focus:ring-0 text-lg"
            >
        </div>

        <!-- Button -->
        <button
            type="submit"
            class="bg-yellow-300 border border-black px-8 py-1.5 text-lg font-medium"
        >
            OK
        </button>

    </form>

    <!-- TITLE -->
    <h1 class="text-center text-3xl font-bold mb-4">
        Tabel Operasional
    </h1>

    <!-- TABLE -->
    <table class="w-full border-collapse text-lg">

        <thead class="bg-yellow-300">
        <tr>
            <th class="px-4 py-2 text-center">Hari</th>
            <th class="px-4 py-2 text-center">Tanggal</th>
            <th class="px-4 py-2 text-center">Keterangan</th>
            <th class="px-4 py-2 text-center">Biaya Operasional</th>
            <th class="px-4 py-2 text-center">Total Biaya</th>
        </tr>
        </thead>

        <tbody>

        @forelse($data as $item)
            <tr class="border-b">

                <td class="px-4 py-2 text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd') }}
                </td>

                <td class="px-4 py-2 text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                </td>

                <td class="px-4 py-2 text-center">
                    {{ $item->keterangan }}
                </td>

                <td class="px-4 py-2 text-center">
                    {{ $item->biaya_operasional }}
                </td>

                <td class="px-4 py-2 text-center">
                    Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4">
                    Tidak ada data
                </td>
            </tr>
        @endforelse

        </tbody>

        <!-- TOTAL -->
        <tfoot>
        <tr>
            <td colspan="4" class="text-center font-bold px-4 py-2">
                Total
            </td>
            <td class="px-4 py-2 font-bold text-center">
                Rp {{ number_format($total, 0, ',', '.') }}
            </td>
        </tr>
        </tfoot>

    </table>

    <!-- ACTION BUTTONS -->
    <div class="flex justify-end gap-6 mt-10 mb-20">

        <button class="bg-yellow-300 border border-black px-6 py-2 text-xl font-medium">
            Save PDF
        </button>

        <button class="bg-yellow-300 border border-black px-10 py-2 text-xl font-medium">
            Print
        </button>

    </div>

</main>

</body>
</html>
  </body>
</html>
