<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_detail', function (Blueprint $table) {
            $table->string('item_name')->nullable();
            $table->string('kategori_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('menu_detail', function (Blueprint $table) {
            $table->dropColumn(['item_name', 'kategori_name']);
        });
    }
};