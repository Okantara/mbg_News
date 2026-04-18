<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operasional', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->string('keterangan', 100)->nullable();
            $table->text('biaya_operasional')->nullable();
            $table->decimal('total_biaya', 12, 0)->default(0);

            $table->timestamps();

            // foreign key ke users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operasional');
    }
};
