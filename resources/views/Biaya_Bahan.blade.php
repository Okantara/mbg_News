@extends('layouts.app')

@section('title', 'MBG || Biaya Bahan')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<main class="flex-grow p-8 max-w-7xl mx-auto w-full">

<!-- ================= FORM ================= -->
<section class="mb-12">

    <h3 class="text-2xl font-bold mb-6">
        {{ isset($data) ? 'Edit Data Biaya Bahan' : 'Tambah Data Biaya Bahan' }}
    </h3>

    <form method="POST"
          action="{{ isset($data) ? route('belanja.update', $data->id) : route('belanja.store') }}"
          class="space-y-6">

        @csrf
        @if(isset($data))
            @method('PUT')
        @endif

        <div class="flex flex-wrap items-end gap-4">

            <!-- HARI (AUTO DARI TANGGAL) -->
            <div class="flex flex-col">
                <label>Hari</label>
                <input type="text"
                       id="hari"
                       name="hari"
                       class="w-32 border px-2 bg-gray-100"
                       value="{{ isset($data) ? $data->hari : '' }}"
                       readonly>
            </div>

            <!-- TANGGAL -->
            <div class="flex flex-col">
                <label>Tanggal</label>
                <input type="date"
                       id="tanggal"
                       name="tanggal"
                       class="border px-2"
                       value="{{ $data->tanggal ?? date('Y-m-d') }}"
                       required>
            </div>

            <!-- SUPPLIER -->
            <div class="flex flex-col">
                <label>Supplier</label>
                <input type="text"
                       name="supplier"
                       class="border px-2"
                       value="{{ $data->supplier ?? '' }}"
                       required>
            </div>

            <!-- PENGELUARAN -->
            <div class="flex flex-col flex-grow">
                <label>Pengeluaran Belanja</label>
                <input type="text"
                       name="pengeluaran_belanja"
                       class="border px-2"
                       value="{{ $data->pengeluaran_belanja ?? '' }}"
                       required>
            </div>

            <!-- TOTAL -->
            <div class="flex flex-col">
                <label>Total Biaya</label>
                <div class="flex items-center">
                    <span class="mr-2">Rp</span>
                    <input type="text"
                           name="total_belanja"
                           class="border px-2 text-right"
                           value="{{ isset($data) ? number_format($data->total_belanja,0,',','.') : '' }}"
                           required>
                </div>
            </div>

            <button type="submit"
                    class="bg-yellow-300 px-6 py-2 border">
                {{ isset($data) ? 'Update' : 'Simpan' }}
            </button>

            @if(isset($data))
                <a href="{{ route('belanja.rekap') }}"
                   class="bg-gray-400 px-6 py-2 border text-white">
                    Batal
                </a>
            @endif

        </div>
    </form>
</section>

<!-- ================= TABLE ================= -->
<section>
    <h2 class="text-2xl font-bold mb-6 text-center">
        Pengeluaran Biaya Bahan Baku
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full border">

            <thead class="bg-yellow-300">
                <tr>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Pengeluaran</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($belanja as $item)
                <tr class="border">

                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd') }}</td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>

                    <td class="text-center">{{ $item->supplier }}</td>

                    <td class="text-center">
                        {{ $item->pengeluaran_belanja }}
                    </td>

                    <td class="text-center">
                        Rp {{ number_format($item->total_belanja,0,',','.') }}
                    </td>

                    <td class="text-center">

                        <a href="{{ route('belanja.edit', $item->id) }}"
                           class="bg-blue-300 px-2 border">
                            Edit
                        </a>

                        <form action="{{ route('belanja.destroy', $item->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Hapus data ini?')">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-300 px-2 border">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr class="font-bold">
                    <td colspan="4" class="text-right p-4">Total</td>
                    <td class="text-right p-4">
                        Rp {{ number_format($total,0,',','.') }}
                    </td>
                    <td></td>
                </tr>
            </tfoot>

        </table>
    </div>
</section>

</main>

<!-- ================= SCRIPT HARI OTOMATIS ================= -->
<script>
    const tanggalInput = document.getElementById('tanggal');
    const hariInput = document.getElementById('hari');

    const hariList = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

    function updateHari() {
        const date = new Date(tanggalInput.value);
        if (!isNaN(date)) {
            hariInput.value = hariList[date.getDay()];
        }
    }

    tanggalInput.addEventListener('change', updateHari);

    // jalankan saat pertama load
    updateHari();
</script>

@endsection