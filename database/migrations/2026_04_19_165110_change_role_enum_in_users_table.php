<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Mbg', 'Keuangan', 'Relawan'])
                  ->default('Relawan')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Sppg', 'Relawan', 'Ahli Gizi'])
                  ->default('Relawan')
                  ->change();
        });
    }
};
