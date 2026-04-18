<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menu_ompreng', function (Blueprint $table) {
            // Tambah kolom ompreng_id jika belum ada
            if (!Schema::hasColumn('menu_ompreng', 'ompreng_id')) {
                $table->foreignId('ompreng_id')
                    ->after('menu_id')
                    ->constrained('ompreng')
                    ->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_ompreng', function (Blueprint $table) {
            if (Schema::hasColumn('menu_ompreng', 'ompreng_id')) {
                $table->dropConstrainedForeignId('ompreng_id');
            }
        });
    }
};
