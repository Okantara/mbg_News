@extends('layouts.app')

@section('title', 'MBG || Home')

@section('content')
    <!-- END: MainHeader -->
    <!-- BEGIN: MainContent -->
    <main class="p-10 pt-24" data-purpose="content-area">

    <!-- Title -->
    <section class="mb-10">
        <h1 class="text-4xl font-bold">Input Password</h1>
    </section>

    <!-- List -->
    <section class="space-y-4 max-w-2xl">

        @foreach ($users as $user)
            <div class="flex items-center space-x-8">

                <!-- Role -->
                <div class="w-48 h-16 bg-custom-yellow border border-black flex items-center justify-center">
                    <span class="text-xl font-bold">
                        {{ $user->role }}
                    </span>
                </div>

                <!-- FORM PASSWORD INLINE -->
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="flex items-center space-x-4 pt-4">
                    @csrf
                    @method('PUT')

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password baru"
                        class="w-48 h-16 border border-black px-3 text-xs text-center"
                        required
                    >

                    <button
                        type="submit"
                        class="text-lg font-bold underline hover:no-underline"
                    >
                        Ubah<br>Password
                    </button>
                </form>

            </div>
        @endforeach

    </section>

</main>
    <!-- END: MainContent -->
  </body>
</html>
