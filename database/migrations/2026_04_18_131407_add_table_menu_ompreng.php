<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menu_ompreng', function (Blueprint $table) {

            // pastikan kolom ada (kalau belum)
            if (!Schema::hasColumn('menu_ompreng', 'menu_id')) {
                $table->foreignId('menu_id')
                    ->constrained('menus')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('menu_ompreng', 'ompreng_id')) {
                $table->foreignId('ompreng_id')
                    ->constrained('ompreng')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('menu_ompreng', 'jumlah')) {
                $table->integer('jumlah');
            }

            // timestamps kalau belum ada
            if (!Schema::hasColumn('menu_ompreng', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('menu_ompreng', function (Blueprint $table) {
            // rollback aman (opsional)
            if (Schema::hasColumn('menu_ompreng', 'menu_id')) {
                $table->dropConstrainedForeignId('menu_id');
            }

            if (Schema::hasColumn('menu_ompreng', 'ompreng_id')) {
                $table->dropConstrainedForeignId('ompreng_id');
            }

            if (Schema::hasColumn('menu_ompreng', 'jumlah')) {
                $table->dropColumn('jumlah');
            }

            // timestamps biasanya tidak di-drop di production
        });
    }
};