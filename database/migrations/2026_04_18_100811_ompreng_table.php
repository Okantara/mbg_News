<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ompreng', function (Blueprint $table) {
            $table->id();

            // relasi ke users (boleh null sesuai desain kamu)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('Kategori_penerima', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
