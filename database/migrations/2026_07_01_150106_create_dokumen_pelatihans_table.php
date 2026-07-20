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
        Schema::create('dokumen_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->enum('jenis_dokumen', ['SK', 'Undangan', 'Lainnya']);
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pelatihans');
    }
};
