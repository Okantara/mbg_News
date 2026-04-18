@extends('layouts.app')

@section('title', 'MBG || Data Kategori & Ompreng')

@section('content')
<main class="p-4 md:p-8 pt-20">

    <!-- ===================== KATEGORI ===================== -->
    <h1 class="text-xl md:text-2xl font-bold mb-6 pt-20 md:mb-8">Input Kategori</h1>

    <section class="mb-12">

        <!-- FORM INPUT -->
        <form action="{{ route('kategori.store') }}" method="POST"
            class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-6">
            @csrf

            <div class="flex border border-black w-full md:w-auto">
                <div class="bg-[#FFFF00] px-3 md:px-4 py-2 font-bold border-r border-black text-sm md:text-base">
                    Kategori
                </div>
                <input
                    name="nama_kategori"
                    class="px-3 md:px-4 py-2 w-full md:w-64 focus:outline-none"
                    type="text"
                    placeholder="Masukkan kategori"
                />
            </div>

            <button type="submit"
                class="border border-black px-4 py-2 md:px-3 md:py-1 text-lg md:text-2xl font-bold hover:bg-gray-100 w-full md:w-auto">
                +
            </button>
        </form>

        <!-- TABLE -->
        <div class="border border-black text-sm md:text-base">
            @foreach ($kategori as $item)
            <div class="flex flex-col md:flex-row md:items-center border-b border-black">

                <div class="flex-grow px-4 py-2 font-semibold">
                    {{ $item->nama_kategori }}
                </div>

                <div class="flex flex-wrap gap-2 px-4 py-2">

                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="hover:bg-gray-200 px-2 py-1">
                            Hapus
                        </button>
                    </form>

                    <form action="{{ route('kategori.update', $item->id) }}" method="POST"
                        class="flex flex-wrap gap-2">
                        @csrf
                        @method('PUT')
                        <input type="text" name="nama_kategori"
                            value="{{ $item->nama_kategori }}"
                            class="border px-2 py-1 w-full md:w-32">
                        <button class="hover:bg-gray-200 px-2 py-1">
                            Edit
                        </button>
                    </form>

                </div>
            </div>
            @endforeach
        </div>
    </section>


    <!-- ===================== OMPRNG ===================== -->
    <h1 class="text-xl md:text-2xl font-bold mb-6 md:mb-8">Input Ompreng</h1>

    <section>

        <!-- FORM INPUT -->
        <form action="{{ route('ompreng.store') }}" method="POST"
            class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 mb-6">
            @csrf

            <div class="flex border border-black w-full md:w-auto">
                <div class="bg-[#FFFF00] px-3 md:px-4 py-2 font-bold border-r border-black text-sm md:text-base">
                    Kategori Penerima
                </div>
                <input
                    name="Kategori_penerima"
                    class="px-3 md:px-4 py-2 w-full md:w-64 focus:outline-none"
                    type="text"
                    placeholder="Masukkan kategori penerima"
                    required
                />
            </div>

            <button type="submit"
                class="border border-black px-4 py-2 md:px-3 md:py-1 text-lg md:text-2xl font-bold hover:bg-gray-100 w-full md:w-auto">
                +
            </button>
        </form>

        <!-- TABLE -->
        <div class="border border-black text-sm md:text-base">
            @foreach ($ompreng as $item)

            <div class="flex flex-col md:flex-row md:items-center border-b border-black">

                <div class="flex-grow px-4 py-2 font-semibold">
                    {{ $item->Kategori_penerima }}
                </div>

                <div class="flex flex-wrap gap-2 px-4 py-2">

                    <form action="{{ route('ompreng.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="hover:bg-gray-200 px-2 py-1"
                            onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>

                    <button type="button"
                        class="hover:bg-gray-200 px-2 py-1"
                        onclick="toggleEditForm({{ $item->id }})">
                        Edit
                    </button>

                </div>
            </div>

            <!-- EDIT FORM -->
            <div id="edit-form-{{ $item->id }}" class="hidden border-t border-black p-4 bg-gray-50">
                <form action="{{ route('ompreng.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col md:flex-row border border-black w-full md:w-fit">
                        <div class="bg-[#FFFF00] px-3 md:px-4 py-2 font-bold border-b md:border-b-0 md:border-r border-black">
                            Kategori Penerima
                        </div>
                        <input
                            type="text"
                            name="Kategori_penerima"
                            value="{{ $item->Kategori_penerima }}"
                            class="px-3 md:px-4 py-2 w-full md:w-64 focus:outline-none"
                        >
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4">
                        <button class="hover:bg-green-200 px-3 py-1">
                            Simpan
                        </button>
                        <button type="button"
                            class="hover:bg-gray-200 px-3 py-1"
                            onclick="toggleEditForm({{ $item->id }})">
                            Batal
                        </button>
                    </div>
                </form>
            </div>

            @endforeach
        </div>

    </section>

</main>

<script>
function toggleEditForm(id) {
    document.getElementById(`edit-form-${id}`).classList.toggle('hidden');
}
</script>

@endsection