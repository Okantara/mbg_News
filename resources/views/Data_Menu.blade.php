@extends('layouts.app')

@section('title', 'MBG || Data Menu')

@section('content')
<!-- BEGIN: Main Content -->

@foreach($kategori as $kat)

<section class="border border-gray-400 rounded-3xl p-8 mb-8 flex flex-col md:flex-row gap-8 pt-24">

    <!-- INPUT -->
    <div class="flex-1 flex items-center">

        <form action="{{ route('item.store') }}" method="POST"
              class="flex w-full border border-gray-400 overflow-hidden">
            @csrf

            <input type="hidden" name="kategori_id" value="{{ $kat->id }}">

            <div class="bg-yellow-custom px-6 py-3 font-bold border-r border-gray-400 min-w-[150px] flex items-center justify-center">
                {{ $kat->nama_kategori }}
            </div>

            <input
                name="nama_item"
                class="flex-1 px-4 py-3 outline-none text-lg"
                type="text"
                placeholder="Tambah item..."
            />

            <button type="submit" class="px-4 py-3 border-l border-gray-400 text-3xl">
                +
            </button>

        </form>

    </div>

    <!-- LIST ITEM -->
    <div class="flex-1">
        <div class="border border-gray-400">

            @forelse($kat->items as $item)
                <div class="flex items-center justify-between border-b border-gray-400 p-2">

                    <span class="font-semibold text-lg px-2">
                        {{ $item->nama_item }}
                    </span>

                    <form action="{{ route('item.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-[10px] border px-2 py-1 rounded">
                            Hapus
                        </button>
                    </form>

                </div>
            @empty
                <div class="p-2 text-gray-500">Belum ada item</div>
            @endforelse

        </div>
    </div>

</section>

@endforeach

<!-- END: Main Content -->
@endsection