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
       Schema::create('laporans', function (Blueprint $table) {
        $table->id();

        // mahasiswa
        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        // relasi akademik
        $table->foreignId('prodi_id')
            ->constrained('prodis')
            ->restrictOnDelete();

        $table->foreignId('periode_magang_id')
            ->constrained('periode_magangs')
            ->restrictOnDelete();

        // data laporan
        $table->string('judul');
        $table->string('file_pdf');

        // pembimbing
        $table->string('dosen_pembimbing');

        // status
        $table->enum('status', ['menunggu','disetujui','revisi'])
            ->default('menunggu');

        // catatan admin
        $table->text('catatan')->nullable();

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

