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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullOnDelete();
            $table->foreignId('jenis_pengaduan_id')->constrained()->nullOnDelete();
            $table->foreignId('kategori_pengaduan_id')->constrained()->nullOnDelete();
            $table->foreignId('channel_pengaduan_id')->constrained()->nullOnDelete();
            $table->foreignId('opd_id')->constrained()->nullOnDelete();
            $table->string('judul');
            $table->string('nama_pengadu');
            $table->string('email_pengadu')->nullable();
            $table->string('telepon_pengadu')->nullable();
            $table->string('nomor_pengaduan');
            $table->longText('isi');
            $table->json('images_path')->nullable();
            $table->string('bukti_terusan_path')->nullable();
            $table->string('bukti_balasan_path')->nullable();
            $table->longText('balasan')->nullable();
            $table->enum('status_respon', ['dalam_proses', 'telah_direspon'])->default('dalam_proses'); 
            $table->enum('status_tindak_lanjut', ['belum_ditindak_lanjuti', 'sudah_ditindak_lanjuti'])->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_profile_anonymous')->default(false);
            $table->boolean('is_pengaduan_public')->default(true);
            $table->boolean('perlu_tindak_lanjut')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
