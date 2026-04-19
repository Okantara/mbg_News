@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')

<main class="pt-5 px-5">
  <div class="flex items-center justify-center pt-16">
    <h1 class="text-2xl font-bold">
        Menu MBG <span>SMK 5</span>
    </h1>
  </div>
</main>

<main class="flex flex-wrap justify-start p-4 gap-6">

@forelse ($menus as $menu)

@php
        $omprengs = collect($menu->omprengs ?? []);

        $totalOmpreng = $omprengs->sum(function ($item) {
            return $item->jumlah ?? 0;
        });
@endphp

<div class="flex flex-col w-96 p-4 bg-blue-200 border border-gray-300 rounded-xl shadow">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-slate-950">
                {{ \Carbon\Carbon::parse($menu->tanggal)->locale('id')->isoFormat('dddd') }}
            </h2>
            <p class="text-sm text-slate-950">
                {{ \Carbon\Carbon::parse($menu->tanggal)->format('d/m/Y') }}
            </p>
        </div>

        <div class="text-right">
            <h2 class="text-2xl font-bold">
                {{ $totalOmpreng }}
            </h2>
            <p class="text-sm text-slate-950">Jumlah Ompreng</p>
        </div>
    </div>

    <!-- DISTRIBUSI -->
    @php
        $omprengs = collect($menu->omprengs ?? []);

        $totalOmpreng = $omprengs->sum(function ($item) {
            return $item->pivot->jumlah ?? 0;
        });
    @endphp

    <div class="grid grid-cols-4 gap-2 p-2 bg-white rounded-lg mt-2 text-xs text-center">

        <div class="col-span-4 grid gap-2">
            
            @forelse($menu->omprengs as $item)
                <div class="bg-yellow-300 rounded px-2 py-1">
                    <div class="font-bold">
                        {{$item->jumlah}}
                    </div>
                    <div class="text-xs">
                        {{ $item->kategori_penerima }}
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-xs">Tidak ada ompreng</p>
            @endforelse

        </div>
    </div>

    <!-- MENU ITEMS -->
<div class="grid grid-cols-6 text-xs mt-3 gap-2">

    <!-- KATEGORI + ITEM -->
    <div class="col-span-5 grid grid-cols-5 gap-2 auto-rows-min">

        @forelse ($menu->items ?? [] as $item)

            <!-- KATEGORI -->
            <p class="bg-yellow-300 rounded px-2 py-1 col-span-2">
                {{ $item->kategori->nama_kategori ?? '-' }}
            </p>

            <!-- ITEM -->
            <p class="p-1 border rounded-lg bg-white col-span-3">
                {{ $item->nama_item ?? '-' }}
            </p>

        @empty
            <p class="text-gray-500 col-span-5">Tidak ada data</p>
        @endforelse

    </div>

    <!-- IMAGE (FULL HEIGHT mengikuti isi kiri) -->
    <div class="col-span-1">
        <img src="{{ asset('Assest/Ompreng.jpeg') }}"
             class="w-full h-full object-cover rounded-lg">
    </div>

</div>

    <!-- CATATAN -->
    <div class="mt-2">
        <p class="text-xs">Catatan :</p>
        <div class="p-2 bg-gray-200 rounded-lg">
            <p class="text-xs text-gray-700">
                {{ $menu->catatan ?? '-' }}
            </p>
        </div>
    </div>

</div>

@empty
    <p class="text-gray-500">Tidak ada menu tersedia</p>
@endforelse

</main>

@endsection