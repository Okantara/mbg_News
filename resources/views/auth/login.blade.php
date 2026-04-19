<!doctype html>

<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - Badan Gizi Nasional</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "surface-container-highest": "#c7e8f1",
              "tertiary-fixed": "#ffdbce",
              "secondary-fixed": "#dae3f5",
              "secondary-fixed-dim": "#bec7d9",
              "surface-tint": "#476083",
              "on-tertiary-fixed": "#351002",
              "on-primary-fixed": "#001c3a",
              "secondary-container": "#d7e0f2",
              "on-secondary": "#ffffff",
              "tertiary-container": "#391303",
              "on-surface-variant": "#43474e",
              "error-container": "#ffdad6",
              tertiary: "#110200",
              outline: "#74777f",
              "surface-dim": "#bfe0e9",
              "on-error": "#ffffff",
              "on-primary-fixed-variant": "#2f486a",
              "inverse-primary": "#afc8f0",
              "surface-container-lowest": "#ffffff",
              "on-tertiary-container": "#b5785f",
              "tertiary-fixed-dim": "#fdb69a",
              background: "#f0fbff",
              "surface-container-high": "#cdeef7",
              "on-surface": "#001f25",
              "primary-fixed": "#d4e3ff",
              "on-secondary-fixed-variant": "#3e4756",
              "on-secondary-fixed": "#131c29",
              primary: "#000613",
              "inverse-surface": "#14353c",
              "on-error-container": "#93000a",
              "on-secondary-container": "#5a6372",
              "outline-variant": "#c4c6cf",
              "surface-container-low": "#dff8ff",
              "on-background": "#001f25",
              "surface-variant": "#c7e8f1",
              secondary: "#565f6e",
              "primary-container": "#001f3f",
              surface: "#f0fbff",
              "primary-fixed-dim": "#afc8f0",
              "on-tertiary": "#ffffff",
              "surface-bright": "#f0fbff",
              "inverse-on-surface": "#d6f6ff",
              "on-primary-container": "#6f88ad",
              "surface-container": "#d2f4fd",
              "on-primary": "#ffffff",
              error: "#ba1a1a",
              "on-tertiary-fixed-variant": "#6b3a25",
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
            fontFamily: {
              headline: ["Public Sans"],
              body: ["Public Sans"],
              label: ["Public Sans"],
            },
          },
        },
      };
    </script>
    <style>
      body {
        font-family: "Public Sans", sans-serif;
        background-color: #c6e7f0; /* Precise background match from user instruction */
      }
      .material-symbols-outlined {
        font-variation-settings:
          "FILL" 0,
          "wght" 400,
          "GRAD" 0,
          "opsz" 24;
      }
    </style>
  </head>
  <body
    class="min-h-screen flex flex-col items-center justify-start py-12 md:py-20 text-on-background"
  >
    <!-- TopAppBar Content - Hidden on Login per Suppression Rule but Branding is Central -->
    <header
    class="flex flex-col items-center text-center px-6 max-w-2xl w-full mb-6 md:mb-6"
    >
    <!-- Logo + Title -->
    <div class="flex flex-col items-center md:flex-row md:items-center">
        <img
        src="Assest/Logo_Badan_Gizi_Nasional_(2024).png"
        alt="BGN"
        class="w-20 h-20 md:w-28 md:h-28 object-contain"
        />
        <h1
        class="text-[#001f3f] font-headline text-xl md:text-3xl font-extrabold tracking-tight leading-tight mt-3 md:mt-0 md:ml-4 text-center md:text-left"
        >
        BADAN GIZI NASIONAL
        </h1>
    </div>

    <!-- Subtext -->
    <div class="mt-3 space-y-1">
        <h2
        class="text-on-surface-variant font-headline text-sm md:text-lg font-bold uppercase"
        >
        SPPG GUBENG SURABAYA
        </h2>
        <p class="text-on-surface-variant font-body text-xs md:text-sm">
        Jl. Kaliwaron No.76-78, Mojo, Gubeng, Surabaya
        </p>
    </div>
    </header>
    <!-- Main Content Canvas: The Login Container -->
    <main class="w-full max-w-md px-6">
      <div class="bg-surface-container-lowest rounded-xl p-8 md:p-10 shadow-[0_20px_40px_rgba(0,31,63,0.04)]">

    <!-- ERROR LOGIN -->
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface-variant" for="name">
                Username
            </label>

            <input
                type="text"
                name="name"
                id="name"
                required
                class="w-full bg-surface-variant border-none rounded-lg px-4 py-3 text-on-surface
                focus:ring-2 focus:ring-primary-container/20 focus:bg-surface-container-lowest
                transition-all outline-none"
            />

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface-variant" for="password">
                Password
            </label>

            <input
                type="password"
                name="password"
                id="password"
                required
                class="w-full bg-surface-variant border-none rounded-lg px-4 py-3 text-on-surface
                focus:ring-2 focus:ring-primary-container/20 focus:bg-surface-container-lowest
                transition-all outline-none"
            />

            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full bg-[#001f3f] text-white font-bold py-3.5 rounded-lg
            hover:bg-opacity-90 active:scale-[0.98] transition-all"
        >
            Masuk
        </button>

    </form>
</div>
  </body>
</html>
