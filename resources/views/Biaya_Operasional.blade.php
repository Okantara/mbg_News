@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')
<!-- MAIN -->
<main class="p-8 max-w-[1400px] mx-auto pt-24">

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 border border-green-600 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM INPUT -->
    <section class="grid grid-cols-12 gap-4 items-end mb-12">

        <form action="{{ route('operasional.store') }}" method="POST" class="contents">
            @csrf

            <!-- Hari (optional hanya display) -->
            <div class="col-span-1">
                <label class="block text-lg mb-1">Hari</label>
                <input type="text" id="hari" class="w-full p-2 border border-black rounded-sm bg-gray-100" readonly>
            </div>

            <!-- Tanggal -->
            <div class="col-span-2">
                <label class="block text-lg mb-1">Tanggal</label>
                <input
                    name="tanggal"
                    id="tanggal"
                    class="w-full p-2 border border-black rounded-sm"
                    type="date"
                    required
                />
            </div>

            <!-- Keterangan -->
            <div class="col-span-2">
                <label class="block text-lg mb-1">Keterangan</label>
                <input
                    name="keterangan"
                    class="w-full p-2 border border-black rounded-sm"
                    type="text"
                    required
                />
            </div>

            <!-- Biaya Operasional -->
            <div class="col-span-4">
                <label class="block text-lg mb-1">Biaya Operasional</label>
                <input
                    name="biaya_operasional"
                    class="w-full p-2 border border-black rounded-sm"
                    type="text"
                    required
                />
            </div>

            <!-- Total Biaya -->
            <div class="col-span-2">
                <label class="block text-lg mb-1">Total Biaya</label>
                <input
                    name="total_biaya"
                    class="w-full p-2 border border-black rounded-sm"
                    type="number"
                    required
                />
            </div>

            <!-- BUTTON -->
            <div class="col-span-1">
                <button
                    type="submit"
                    class="w-full py-2 bg-yellow-300 border border-black rounded-lg font-bold text-lg hover:brightness-95"
                >
                    OK
                </button>
            </div>

        </form>
    </section>

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold">Biaya Operasional</h1>
    </div>

    <!-- TABLE -->
    <section class="mb-8">

        <table class="w-full text-center border-collapse border border-black">

            <thead class="bg-yellow-300 border border-black">
                <tr>
                    <th class="p-2">Hari</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Keterangan</th>
                    <th class="p-2">Biaya Operasional</th>
                    <th class="p-2">Total Biaya</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-lg">

                @forelse($data as $item)
                    <tr class="border border-black">

                        <td class="p-2">
                            {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd') }}
                        </td>

                        <td class="p-2">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        </td>

                        <td class="p-2">
                            {{ $item->keterangan }}
                        </td>

                        <td class="p-2 text-left px-4">
                            {{ $item->biaya_operasional }}
                        </td>

                        <td class="p-2">
                            Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                        </td>

                        <td class="p-2">
                            <div class="flex justify-center gap-2">

                                <!-- EDIT (optional nanti bisa modal) -->
                                <form action="{{ route('operasional.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-yellow-300 border border-black px-3 text-sm rounded"
                                        onclick="return confirm('Hapus data?')"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4">Tidak ada data</td>
                    </tr>
                @endforelse

            </tbody>

            <!-- FOOTER TOTAL -->
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right font-bold text-xl p-2">Total</td>
                    <td class="p-2 border border-black bg-white">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </td>
                    <td></td>
                </tr>
            </tfoot>

        </table>
    </section>

</main>

<!-- SCRIPT auto hari -->
<script>
    const tanggal = document.getElementById('tanggal');
    const hari = document.getElementById('hari');

    tanggal?.addEventListener('change', function () {
        const date = new Date(this.value);
        const options = { weekday: 'long' };
        hari.value = date.toLocaleDateString('id-ID', options);
    });
</script>

</body>
</html>
