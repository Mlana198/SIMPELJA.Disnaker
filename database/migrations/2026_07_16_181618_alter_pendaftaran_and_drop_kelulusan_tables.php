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
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status_kelulusan', ['lulus', 'tidak_lulus', 'pending'])
                ->default('pending')
                ->after('status_seleksi_administrasi');
        });

        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropForeign(['kelulusan_id']);
            $table->dropColumn('kelulusan_id');

            $table->foreignId('pendaftaran_id')
                ->after('id')
                ->constrained('pendaftaran')
                ->onDelete('cascade');
        });

        Schema::dropIfExists('kelulusan');
        Schema::dropIfExists('laporan_pelatihan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('status_kelulusan');
        });

        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropForeign(['pendaftaran_id']);
            $table->dropColumn('pendaftaran_id');
            $table->foreignId('kelulusan_id')->nullable()->constrained('kelulusan');
        });
    }
};
