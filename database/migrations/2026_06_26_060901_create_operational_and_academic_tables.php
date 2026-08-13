<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 8. Tabel jadwal_interview
        Schema::create('jadwal_interview', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->foreignId('interviewer_user_id')->constrained('users')->onDelete('restrict');
            $table->dateTime('waktu_interview');
            $table->string('tempat_atau_link', 255);
            $table->timestamps();
        });

        // 9. Tabel penilaian_interviews
        Schema::create('penilaian_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_interview_id')->constrained('jadwal_interview')->onDelete('cascade');
            $table->integer('skor_minat')->unsigned();
            $table->integer('skor_bakat')->unsigned();
            $table->text('catatan_kualitatif')->nullable();
            $table->enum('status_akhir', ['Lulus', 'Cadangan', 'Gagal'])->default('Lulus');
            $table->enum('status_pengajuan', ['Draft', 'Diajukan Subkoor', 'Disetujui Kabid'])->default('Draft');
            $table->timestamps();
        });

        // 10. Tabel materi_pelatihan
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

        // 11. Tabel absensi
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('status_kehadiran', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->timestamps();
        });

        // 12. Tabel penilaian
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

        // 13. Tabel sertifikat
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->string('nomor_sertifikat', 50)->unique();
            $table->string('ditandatangani_oleh_nama', 100);
            $table->string('ditandatangani_oleh_nip', 30);
            $table->string('nomor_sk_kadis')->nullable();
            $table->date('tanggal_sk_kadis')->nullable();
            $table->integer('durasi_pelatihan')->nullable();
            $table->date('tanggal_terbit');
            $table->string('file_sertifikat_path', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
        Schema::dropIfExists('kelulusan');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('materi_pelatihan');
        Schema::dropIfExists('jadwal_interview');
    }
};
