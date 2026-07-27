<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 7. Tabel jadwal_interview
        Schema::create('jadwal_interview', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->foreignId('interviewer_user_id')->constrained('users')->onDelete('restrict');
            $table->dateTime('waktu_interview');
            $table->string('tempat_atau_link', 255);
            $table->timestamps();
        });

        // 8. Tabel materi_pelatihan
        Schema::create('materi_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->string('judul_materi', 100);
            $table->text('deskripsi');
            $table->string('file_materi_path', 255)->nullable();
            $table->string('link_video', 255)->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });

        // 9. Tabel absensi
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('status_kehadiran', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->timestamps();
        });

        // 10. Tabel penilaian
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->float('nilai_teori')->nullable();
            $table->float('nilai_praktek')->nullable();
            $table->float('nilai_akhir')->nullable();
            $table->text('catatan_instruktur')->nullable();
            $table->foreignId('instruktur_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });

        // 11. Tabel kelulusan
        Schema::create('kelulusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status_kelulusan', ['lulus', 'tidak_lulus', 'pending'])->default('pending');
            $table->timestamps();
        });

        // 12. Tabel laporan_pelatihan
        Schema::create('laporan_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->string('file_laporan_pdf', 255)->nullable();
            $table->integer('total_pendaftar');
            $table->integer('total_peserta_lulus');
            $table->double('rata_rata_nilai');
            $table->text('kendala_dan_solusi')->nullable();
            $table->date('tanggal_pelaporan');
            $table->boolean('disetujui_oleh_kabid')->default(false);
            $table->timestamps();
        });

        // 13. Tabel sertifikat
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelulusan_id')->constrained('kelulusan')->onDelete('cascade');
            $table->string('nomor_sertifikat', 50)->unique();
            $table->string('ditandatangani_oleh_nama', 100);
            $table->string('ditandatangani_oleh_nip', 30);
            $table->string('file_sertifikat_path', 255);
            $table->date('tanggal_terbit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
        Schema::dropIfExists('laporan_pelatihan');
        Schema::dropIfExists('kelulusan');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('materi_pelatihan');
        Schema::dropIfExists('jadwal_interview');
    }
};
