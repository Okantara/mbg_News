@extends('layouts.app')

@section('title', 'MBG || Input Menu')

@section('content')

<section class="px-4 sm:px-8 py-4 pt-20 text-center">
  <h1 class="text-2xl sm:text-3xl font-bold italic">Input Menu</h1>
</section>

<main class="px-4 sm:px-8 pb-12">

  {{-- Alert Messages --}}
  @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
      {{ session('success') }}
    </div>
  @endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

  {{-- ================= KOLOM FORM INPUT ================= --}}
  <div class="flex justify-center">
    <form action="{{ route('menu.store') }}" method="POST"
      class="border border-black p-4 flex flex-col gap-3 w-full">

      @csrf

      <!-- {{-- Hari --}}
      <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
        <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
          Hari
        </span>
        <input type="text" name="hari"
          class="w-full border border-black h-10 px-3 text-sm font-semibold"
          value="{{ now()->format('l') }}" readonly>
      </div> -->

      {{-- Tanggal --}}
      <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
        <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
          Tanggal
        </span>
        <input type="date" name="tanggal"
          class="w-full border border-black h-10 px-3 text-sm"
          value="{{ now()->format('Y-m-d') }}" required>
      </div>

      {{-- Kategori --}}
      <div class="mt-4 space-y-2">
        @foreach($kategori as $kat)
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
          <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
            {{ $kat->nama_kategori }}
          </span>

          <select name="items[{{ $kat->id }}]"
            class="w-full border border-black h-10 px-2 text-sm bg-white">
            <option value="">-- Pilih --</option>
            @foreach($kat->items as $item)
              <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
            @endforeach
          </select>
        </div>
        @endforeach
      </div>

      {{-- Ompreng --}}
      <div class="mt-4">
        <p class="text-xs font-bold mb-2">Isi Data Ompreng</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 border border-black rounded p-2">
          @foreach ($ompreng as $o)
            <div class="flex flex-col items-center">
              <input type="number"
                name="ompreng_jumlah[{{ $o->id }}]"
                min="0" value="0"
                class="w-full border border-black text-center text-sm py-1 mb-1">

              <span class="text-[10px] text-center font-semibold">
                {{ $o->Kategori_penerima }}
              </span>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Catatan --}}
      <div class="mt-4">
        <p class="text-xs">Catatan :</p>
        <input type="text" name="catatan"
          class="w-full border border-gray-300 rounded h-10 mt-1 px-3 text-sm"
          placeholder="Tambahkan catatan...">
      </div>

      {{-- Button --}}
      <div class="mt-4 flex flex-col sm:flex-row gap-2 sm:justify-between">
        <button type="reset"
          class="bg-red-500 text-white font-bold px-4 py-2 text-sm w-full sm:w-auto hover:bg-red-600">
          Hapus
        </button>

        <button type="submit"
          class="bg-blue-500 text-white font-bold px-4 py-2 text-sm w-full sm:w-auto hover:bg-blue-600">
          Simpan
        </button>
      </div>

    </form>
  </div>


  {{-- ================= KOLOM HAPUS MENU ================= --}}
  <div class="border border-gray-400 p-4">
    <h1 class="text-lg font-bold mb-3 text-center">Hapus Daftar Menu Tayang</h1>

    <div class="overflow-x-auto">
      <table class="w-full border border-black text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="border border-black px-3 py-2">Tanggal</th>
            <th class="border border-black px-3 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($menusApproved as $menu)
          <tr>
            <td class="border border-black px-3 py-2 text-center">
              {{ $menu->tanggal }}
            </td>

            <td class="border border-black px-3 py-2 text-center">
              <form action="{{ route('menu.delete', $menu->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button
                  onclick="return confirm('Yakin mau hapus menu ini?')"
                  class="bg-red-500 text-white font-bold px-3 py-1 text-sm hover:bg-red-600">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>


  {{-- ================= LIST MENU ================= --}}
  <div class="mt-12 text-center">
    <h1 class="text-2xl sm:text-3xl font-bold italic">Menu Sebelum Tayang</h1>
  </div>

  <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

    @forelse ($menus as $menu)
    <div class="border border-gray-400 p-4 flex flex-col gap-3">

      {{-- Hari --}}
      <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
        <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
          Hari
        </span>
        <input type="text"
          value="{{ \Carbon\Carbon::parse($menu->tanggal)->locale('id')->translatedFormat('l') }}"
          class="w-full border border-black h-10 px-3 text-sm"
          readonly>
      </div>

      {{-- Tanggal --}}
      <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
        <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
          Tanggal
        </span>
        <input type="text"
          value="{{ \Carbon\Carbon::parse($menu->tanggal)->format('d/m/Y') }}"
          class="w-full border border-black h-10 px-3 text-sm"
          readonly>
      </div>

      {{-- Items --}}
      <div class="mt-3 space-y-2">
        @foreach ($kategori as $kat)
          @php
            $selectedItem = $menu->items->firstWhere('kategori_id', $kat->id);
          @endphp

          <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <span class="bg-yellow-300 font-bold px-3 py-2 w-full sm:w-32 text-center border border-black text-sm">
              {{ $kat->nama_kategori }}
            </span>

            <input type="text"
              class="w-full border border-black h-8 px-2 text-sm"
              value="{{ $selectedItem->nama_item ?? '-' }}"
              readonly>
          </div>
        @endforeach
      </div>

      {{-- Ompreng Display --}}
      <div class="mt-3">
        <p class="text-xs font-bold mb-1">Isi Data Ompreng</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
          @if($menu->omprengs->count() > 0)
          @foreach ($menu->detailOmpreng as $o)
              <div class="bg-blue-500 text-white text-xs text-center py-2 rounded">
                  {{ $o->jumlah }} <br>
                  <span class="text-[9px]">{{ $o->kategori_penerima }}</span>
              </div>
          @endforeach
          @else
            <p class="text-[9px] text-gray-500 col-span-full">Belum ada ompreng</p>
          @endif
        </div>
      </div>

      {{-- Catatan --}}
      <div class="mt-3">
        <p class="text-xs">Catatan :</p>
        <input type="text"
          class="w-full border border-gray-300 rounded h-10 mt-1 px-3 text-sm"
          value="{{ $menu->catatan ?? '-' }}"
          readonly>
      </div>

      {{-- Button --}}
      <div class="mt-4 flex flex-col sm:flex-row gap-2 sm:justify-between">

        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
          @csrf
          @method('DELETE')
          <button class="bg-red-500 text-white px-4 py-2 text-sm w-full hover:bg-red-600">
            Hapus
          </button>
        </form>

        <form action="{{ route('menu.tayang', $menu->id) }}" method="POST" class="w-full sm:w-auto">
          @csrf
          @method('PATCH')
          <button class="bg-blue-500 text-white px-4 py-2 text-sm w-full hover:bg-blue-600">
            Tayang
          </button>
        </form>

      </div>

    </div>
    @empty
      <div class="col-span-full text-center py-8">
        <p class="text-gray-500">Belum ada menu yang disimpan</p>
      </div>
    @endforelse

  </div>

</main>
@endsection