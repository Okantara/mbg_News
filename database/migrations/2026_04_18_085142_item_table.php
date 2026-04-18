<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item', function (Blueprint $table) {
            $table->id();

            // relasi
            $table->unsignedBigInteger('kategori_id');

            // snapshot kategori (PENTING 🔥)
            $table->string('kategori_nama', 100);

            // data item
            $table->string('nama_item', 100);

            $table->timestamps();
            $table->softDeletes(); // soft delete

            // foreign key (jangan cascade!)
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('restrict'); // atau set null kalau mau fleksibel
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
