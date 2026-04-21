@extends('pdf.layout')

@section('content')

<h2>Rekap Menu</h2>

<table>
    <thead>
        <tr>
            <th>Hari, Tanggal</th>

            @foreach($kategoriOrder as $kategori)
                <th>{{ $kategori }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row['hari_tanggal'] }}</td>

            @foreach($kategoriOrder as $kategori)
                <td>{{ $row[$kategori] ?? '-' }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
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

@endsection