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
        Schema::create('antrean_panggils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antrean_id')->constrained();
            $table->foreignId('lokasi_id')->constrained();
            $table->foreignId('layanan_id')->constrained();
            $table->foreignId('loket_id')->constrained();
            $table->date('tanggal_panggil');
            $table->time('jam_panggil');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrean_panggils');
    }
};
