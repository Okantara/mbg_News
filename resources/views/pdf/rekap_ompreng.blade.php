@extends('pdf.layout')

@section('content')

<h2 style="text-align:center;">Rekap Ompreng</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Tanggal</th>

            @foreach($kategoriList as $kategori)
                <th>{{ ucfirst($kategori) }}</th>
            @endforeach

            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $row)
            <tr>
                <td>{{ $row['hari_tanggal'] }}</td>

                @foreach($kategoriList as $kategori)
                    <td>
                        {{ $row[$kategori] ?? 0 }}
                    </td>
                @endforeach

                <td>
                    {{ $row['total'] ?? 0 }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($kategoriList) + 2 }}" align="center">
                    Data tidak ditemukan
                </td>
            </tr>
        @endforelse
    </tbody>

    <tfoot>
        <tr>
            <th colspan="{{ count($kategoriList) + 1 }}">Total</th>
            <th>
                {{ $data->sum('total') }}
            </th>
        </tr>
    </tfoot>
</table>

<br><br><br>

<h5 style='text-align:center'>Surabaya, .......................</h5>
{{-- ================= TANDA TANGAN ================= --}}
<table width="100%" style="text-align:center;">
    <tr>
        <td width="33%">
            Mengetahui<br>
            SPPG<br><br><br><br>
            (_________________)
        </td>

        <td width="33%">
            Keuangan<br><br><br><br>
            (_________________)
        </td>

        <td width="33%">
            Yayasan<br><br><br><br>
            (_________________)
        </td>
    </tr>
</table>

@endsection