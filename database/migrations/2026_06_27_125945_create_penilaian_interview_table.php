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
        Schema::create('penilaian_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_interview_id')->constrained('jadwal_interview')->onDelete('cascade');
            $table->integer('skor_minat')->unsigned();
            $table->integer('skor_bakat')->unsigned();
            $table->text('catatan_kualitatif')->nullable();
            $table->enum('status_akhir', ['Lulus', 'Cadangan', 'Gagal'])->default('Lulus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_interviews');
    }
};
