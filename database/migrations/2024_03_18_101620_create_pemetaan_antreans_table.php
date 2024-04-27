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
        Schema::create('pemetaan_antreans', function (Blueprint $table) {
            $table->foreignId('lokasi_id')->constrained();
            $table->foreignId('layanan_id')->constrained();
            $table->foreignId('loket_id')->constrained();   
            $table->string('status');         
            $table->timestamps();
            $table->primary(['lokasi_id', 'layanan_id', 'loket_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemetaan_antreans');
    }
};
