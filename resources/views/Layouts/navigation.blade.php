<nav x-data="{ open: false, yayasan: false, dataMenu: false, keuangan: false }"
     class="bg-blue-600 text-white fixed top-0 left-0 right-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-8">

                <!-- Logo -->
                <a href="{{ route('Home') }}" class="flex items-center">
                    <img src="./Assest/Logo_Badan_Gizi_Nasional_(2024).png"
                         class="h-8" alt="Logo">
                </a>

                <!-- YAYASAN -->
                <div class="relative">
                    <button @click="yayasan = !yayasan" class="hover:underline">
                        Yayasan
                    </button>

                    <div x-show="yayasan" @click.away="yayasan = false"
                        class="absolute mt-2 bg-white text-black shadow rounded min-w-[180px]">
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Password</a>
                        <a href="{{ route('kategori.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Input Kategori & Ompreng</a>
                        <a href="{{ route('item.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Input Data Menu</a>
                    </div>
                </div>

                <!-- DATA MENU -->
                <div class="relative">
                    <button @click="dataMenu = !dataMenu" class="hover:underline">
                        Data Menu
                    </button>

                    <div x-show="dataMenu" @click.away="dataMenu = false"
                        class="absolute mt-2 bg-white text-black shadow rounded min-w-[180px]">
                        <a href="{{ route('menu.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Input Menu</a>
                        <a href="{{ route('rekap.menu') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Tabel Menu</a>
                        <a href="{{ route('rekap.ompreng') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Tabel Ompreng</a>
                    </div>
                </div>

                <!-- KEUANGAN -->
                <div class="relative">
                    <button @click="keuangan = !keuangan" class="hover:underline">
                        Keuangan
                    </button>

                    <div x-show="keuangan" @click.away="keuangan = false"
                        class="absolute mt-2 bg-white text-black shadow rounded min-w-[180px]">
                        <a href="{{ route('belanja.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Biaya Belanja</a>
                        <a href="{{ route('operasional.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Biaya Operasional</a>
                        <a href="{{ route('rekap_belanja') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Tabel Biaya</a>
                        <a href="{{ route('rekap.operasional') }}" class="block px-4 py-2 text-xs hover:bg-gray-100">Tabel Operasional</a>
                    </div>
                </div>

            </div>

            <!-- RIGHT (USER DROPDOWN) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

            <x-dropdown align="right" width="70">
                <x-slot name="trigger">
                    <button class="inline-flex items-center gap-2 text-sm px-3 py-2 rounded hover:bg-blue-700 cursor-pointer transition">

                        <div class="flex flex-col items-center leading-tight">
                            <span class="text-xs text-white/80">Selamat Datang</span>
                            <span class="font-semibold text-white">
                                {{ Auth::user()->name }}
                            </span>
                        </div>

                        <!-- tanda dropdown -->
                        <svg class="w-4 h-4 text-white/80" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>
                </x-slot>

                    <x-slot name="content">
                        <!-- <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link> -->

                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-black">
                            Log Out
                        </button>
                    </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- MOBILE -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open">☰</button>
            </div>

        </div>
    </div>
</nav>