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
        Schema::create('layanan_loket', function (Blueprint $table) {
            $table->foreignId('layanan_id')->constrained();
            $table->foreignId('loket_id')->constrained();            
            $table->timestamps();
            $table->primary(['layanan_id', 'loket_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_loket');
    }
};