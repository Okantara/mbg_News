<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->enum('status', ['draft', 'approved'])
                  ->default('draft')
                  ->after('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};