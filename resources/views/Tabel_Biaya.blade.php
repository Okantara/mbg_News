@extends('layouts.app')

@section('title', 'MBG || Tabel Biaya Belanja')

@section('content')

<main class="max-w-6xl mx-auto mt-20 px-4 pt-6">

    <!-- FILTER -->
    <section class="flex items-center gap-4 mb-12">

        <form method="GET" class="flex items-center gap-4">

            <input
                type="date"
                name="tanggal_awal"
                class="border border-gray-400 px-4 py-2 rounded text-lg w-48"
                value="{{ request('tanggal_awal') }}"
            >

            <input
                type="date"
                name="tanggal_akhir"
                class="border border-gray-400 px-4 py-2 rounded text-lg w-48"
                value="{{ request('tanggal_akhir') }}"
            >

            <button
                type="submit"
                class="bg-yellow-400 border border-gray-400 px-8 py-2 text-lg font-bold rounded shadow-sm hover:bg-yellow-500"
            >
                OK
            </button>

        </form>

    </section>

    <!-- TABLE -->
    <section class="flex flex-col items-center">

        <h1 class="text-3xl font-bold mb-6">
            Tabel biaya belanja
        </h1>

        <div class="w-full overflow-x-auto">

            <table class="w-full border-collapse border border-black">

                <thead class="bg-yellow-400">
                    <tr>
                        <th class="border border-black p-3 text-center">Hari</th>
                        <th class="border border-black p-3 text-center">Tanggal</th>
                        <th class="border border-black p-3 text-center">Supplier</th>
                        <th class="border border-black p-3 text-center">Pengeluaran_Belanja</th>
                        <th class="border border-black p-3 text-center">Total Biaya</th>
                    </tr>
                </thead>

                <tbody class="text-lg">

                    @foreach($belanja as $b)
                    <tr>
                        <td class="border border-black p-3 text-center">
                            {{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('l') }}
                        </td>

                        <td class="border border-black p-3 text-center">
                            {{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}
                        </td>

                        <td class="border border-black p-3 text-center">
                            {{ $b->supplier }}
                        </td>

                        <td class="border border-black p-3 text-center">
                            {{ $b->pengeluaran_belanja }}
                        </td>

                        <td class="border border-black p-3 text-center">
                            {{ $b->total_belanja }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>

                <!-- REKAP TOTAL -->
                <tfoot>
                    <tr class="font-bold">
                        <td colspan="4" class="border border-black p-3 text-right">
                            Total
                        </td>
                        <td class="border border-black p-3 text-center">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>

            </table>

        </div>

    </section>

</main>

</body>
</html>