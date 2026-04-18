@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')
    <!-- END: MainHeader -->
    <!-- BEGIN: MainContent -->
    <main class="max-w-7xl mx-auto p-8 pt-16" data-purpose="main-content">
      <!-- BEGIN: PageTitle -->
      <section class="mb-10 text-center md:text-left">
        <h1 class="text-3xl font-bold" data-purpose="page-heading">
          Table Menu Rekab ompreng
        </h1>
      </section>
      <!-- END: PageTitle -->
      <!-- BEGIN: FilterControls -->
      <section
        class="flex flex-wrap items-center gap-4 mb-8"
        data-purpose="filter-controls"
      >
        <!-- Date Pickers -->
        <div class="relative">
          <input
            class="border border-gray-400 px-4 py-2 pr-10 w-48 text-lg"
            readonly=""
            type="text"
            value="13/04/2026"
          />
          <span
            class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
            >▼</span
          >
        </div>
        <div class="relative">
          <input
            class="border border-gray-400 px-4 py-2 pr-10 w-48 text-lg"
            readonly=""
            type="text"
            value="18/04/2026"
          />
          <span
            class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
            >▼</span
          >
        </div>
        <!-- Action Buttons -->
        <div class="flex gap-4 ml-4">
          <button
            class="bg-yellow-bright px-8 py-2 border border-gray-500 rounded text-lg font-medium hover:bg-yellow-400 transition-colors"
          >
            OK
          </button>
          <button
            class="bg-yellow-bright px-4 py-2 border border-gray-500 rounded text-lg font-medium hover:bg-yellow-400 transition-colors"
          >
            Save PDF
          </button>
          <button
            class="bg-yellow-bright px-8 py-2 border border-gray-500 rounded text-lg font-medium hover:bg-yellow-400 transition-colors"
          >
            Print
          </button>
        </div>
      </section>
      <!-- END: FilterControls -->
      <!-- BEGIN: DataTable -->
      <section class="overflow-x-auto" data-purpose="data-table-container">
        <table
          class="w-full border-collapse table-custom text-center text-lg"
          id="rekab-table"
        >
          <thead class="bg-white">
            <tr>
              <th class="py-3 px-4 font-normal">Hari, Tanggal</th>
              <th class="py-3 px-4 font-normal">SMK</th>
              <th class="py-3 px-4 font-normal">Santri</th>
              <th class="py-3 px-4 font-normal">Ibu Hamil</th>
              <th class="py-3 px-4 font-normal">Balita</th>
              <th class="py-3 px-4 font-normal">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="py-2 px-4 text-left">Senin, 13/04/2026</td>
              <td class="py-2 px-4">2800</td>
              <td class="py-2 px-4">400</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">3500</td>
            </tr>
            <tr>
              <td class="py-2 px-4 text-left">Selasa, 14/04/2026</td>
              <td class="py-2 px-4">2800</td>
              <td class="py-2 px-4">400</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">3500</td>
            </tr>
            <tr>
              <td class="py-2 px-4 text-left">Rabu, 15/04/2026</td>
              <td class="py-2 px-4">2800</td>
              <td class="py-2 px-4">400</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">3500</td>
            </tr>
            <tr>
              <td class="py-2 px-4 text-left">Kamis, 16/04/2026</td>
              <td class="py-2 px-4">2800</td>
              <td class="py-2 px-4">400</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">3500</td>
            </tr>
            <tr>
              <td class="py-2 px-4 text-left">Juma’at, 17/04/2026</td>
              <td class="py-2 px-4">2800</td>
              <td class="py-2 px-4">0</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">3100</td>
            </tr>
            <tr>
              <td class="py-2 px-4 text-left">Sabtu, 18/04/2026</td>
              <td class="py-2 px-4">0</td>
              <td class="py-2 px-4">400</td>
              <td class="py-2 px-4">200</td>
              <td class="py-2 px-4">100</td>
              <td class="py-2 px-4">700</td>
            </tr>
          </tbody>
          <tfoot class="font-normal">
            <tr>
              <!-- Empty cells to push 'Jumlah' to the right -->
              <td class="border-none" colspan="4"></td>
              <td class="py-2 px-4">Jumlah</td>
              <td class="py-2 px-4">17800</td>
            </tr>
          </tfoot>
        </table>
      </section>
      <!-- END: DataTable -->
    </main>
    <!-- END: MainContent -->
    <!-- BEGIN: Scripts -->
    <script data-purpose="button-interactions">
      // Placeholder for interaction logic (PDF generation, Printing, etc.)
      document.querySelectorAll("button").forEach((btn) => {
        btn.addEventListener("click", () => {
          if (btn.innerText === "Print") {
            window.print();
          } else {
            console.log(`Action triggered: ${btn.innerText}`);
          }
        });
      });
    </script>
    <!-- END: Scripts -->
  </body>
</html>
