<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Google Fonts for sans-serif look -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <style data-purpose="custom-typography">
      body {
        font-family: "Inter", sans-serif;
        background-color: #ffffff;
      }
      .text-admin {
        color: #333;
        font-size: 2.5rem;
        font-weight: 400;
      }
    </style>
    <style data-purpose="custom-colors">
      .bg-cyan-custom {
        background-color: #00ccff;
      }
      .bg-yellow-custom {
        background-color: #ffff00;
      }
      .border-custom {
        border-color: #999;
      }
    </style>
</head>
<body class="p-0 m-0">
    @include('include.navbar')

    @yield('content')

<script>
    function toggleMenu(event, element) {
      event.stopPropagation();

      const dropdown = element.nextElementSibling;

      const isOpen = !dropdown.classList.contains("hidden");

      // tutup semua dropdown
      document.querySelectorAll(".dropdown").forEach(menu => {
        menu.classList.add("hidden");
      });

      // buka jika sebelumnya tertutup
      if (!isOpen) {
        dropdown.classList.remove("hidden");
      }
    }

    // klik di luar → tutup semua dropdown
    document.addEventListener("click", function () {
      document.querySelectorAll(".dropdown").forEach(menu => {
        menu.classList.add("hidden");
      });
    });
  </script>
    
</body>
</html>