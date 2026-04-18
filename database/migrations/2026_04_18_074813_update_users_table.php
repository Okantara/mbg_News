<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // tambah kolom kalau belum ada
            $table->string('nama', 100)->nullable()->after('id');

            $table->enum('role', ['Admin', 'Sppg', 'Relawan', 'Ahli Gizi'])
                  ->nullable()
                  ->after('password');

            // kalau tabel lama masih pakai email/name dan kamu tidak butuh:
            // $table->dropColumn('email');
            // $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'role']);
        });
    }
};
