<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('item', function (Blueprint $table) {
            // hapus foreign key dulu
            $table->dropForeign(['kategori_id']);
        });

        Schema::table('item', function (Blueprint $table) {
            // hapus kolom lama
            $table->dropColumn('kategori_id');
        });

        Schema::table('item', function (Blueprint $table) {
            // buat ulang kolom (nullable)
            $table->unsignedBigInteger('kategori_id')->nullable();

            // buat foreign key baru
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('item', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });

        Schema::table('item', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id');

            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('restrict');
        });
    }
};
