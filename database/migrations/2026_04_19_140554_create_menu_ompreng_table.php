<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_ompreng', function (Blueprint $table) {
            $table->id();

            $table->foreignId('menu_id')
                ->constrained('menu')
                ->cascadeOnDelete();

            $table->foreignId('ompreng_id')
                ->constrained('ompreng')
                ->cascadeOnDelete();

            $table->integer('jumlah');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_ompreng');
    }
};
