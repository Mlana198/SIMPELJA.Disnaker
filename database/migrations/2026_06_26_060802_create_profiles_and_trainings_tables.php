<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel profil_pengguna
        Schema::create('profil_pengguna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap', 100);
            $table->string('no_hp', 15)->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        // 2. Tabel beritas
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->text('konten');
            $table->string('foto_banner')->nullable();
            $table->dateTime('tanggal_publish');
            $table->timestamps();
        });

        // 3. Tabel pelatihans
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelatihan', 100);
            $table->text('deskripsi');
            $table->integer('kuota');
            $table->integer('angkatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_periode', ['aktif', 'non-aktif', 'selesai']);
            $table->timestamps();
        });

        // 4. Tabel pendaftaran
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('pelatihans_id')->constrained('pelatihans')->onDelete('restrict');
            $table->date('tanggal_daftar');
            $table->enum('status_seleksi_administrasi', ['pending', 'lolos', 'tidak_lolos'])->default('pending');
            $table->text('catatan_keputusan')->nullable();
            $table->timestamps();
        });

        // 5. Tabel berkas_pendaftaran
        Schema::create('berkas_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->string('jenis_berkas', 30);
            $table->string('file_path', 255);
            $table->timestamps();
        });

        // 6. Tabel bukti_pendaftaran
        Schema::create('bukti_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->string('nomor_registrasi', 50)->unique();
            $table->string('file_bukti_path', 255)->nullable();
            $table->dateTime('tanggal_issued');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukti_pendaftaran');
        Schema::dropIfExists('berkas_pendaftaran');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('pelatihans');
        Schema::dropIfExists('beritas');
        Schema::dropIfExists('profil_pengguna');
    }
};
