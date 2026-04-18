<header class="fixed top-0 left-0 right-0 z-50">
      <div
        class="flex items-center justify-between py-5 px-5 bg-blue-600 text-white w-full"
      >
        <!-- KIRI -->
        <div class="flex items-center gap-8">
          <a href="{{ route('Home') }}"><img src="./Assest/Logo_Badan_Gizi_Nasional_(2024).png" alt="Logo" class="h-8"></a>
          <!-- Dropdown Yayasan -->
          <!-- Yayasan -->
    <div class="relative">
      <a href="#" onclick="toggleMenu(event, this)" class="hover:underline">
        Yayasan
      </a>

      <div onclick="event.stopPropagation()" 
        class="hidden absolute left-0 top-full mt-2 bg-white shadow-md min-w-[150px] rounded dropdown">
        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Password</a>
        <a href="{{ route('kategori.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Input Kategori & Ompreng</a>
        <a href="{{ route('item.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Input Data Menu</a>
      </div>
    </div>

    <!-- Data Menu -->
    <div class="relative">
      <a href="#" onclick="toggleMenu(event, this)" class="hover:underline">
        Data Menu
      </a>

      <div onclick="event.stopPropagation()" 
           class="hidden absolute left-0 top-full mt-2 bg-white shadow-md min-w-[150px] rounded dropdown">
        <a href="{{ route('menu.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Input Menu</a>
        <a href="#" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Tabel Menu</a>
        <a href="#" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Tabel Ompreng</a>
      </div>
    </div>

    <!-- Keuangan -->
    <div class="relative">
      <a href="#" onclick="toggleMenu(event, this)" class="hover:underline">
        Keuangan
      </a>

      <div onclick="event.stopPropagation()" 
           class="hidden absolute left-0 top-full mt-2 bg-white shadow-md min-w-[150px] rounded dropdown">
        <a href="{{ route('belanja.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Biaya belanja</a>
        <a href="{{ route('operasional.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Biaya Operasional</a>
        <a href="{{ route('rekap_belanja') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Tabel Biaya</a>
        <a href="{{ route('rekap.operasional') }}" class="block px-4 py-2 text-xs hover:bg-gray-100 text-slate-950">Tabel Operasional</a>
      </div>
    </div>
  </div>
</header>