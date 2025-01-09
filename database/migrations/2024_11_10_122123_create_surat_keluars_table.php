<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('tujuan');
            $table->date('tanggal');
            $table->string('perihal');
            $table->text('isi');
            $table->enum('status', ['Draft', 'Proses Persetujuan','Disetujui','Terkirim'])->default('Draft');
            $table->string('file_path')->nullable();
            $table->string('jenis_layanan')->nullable();
            $table->string('username');
            $table->timestamps();
            
            $table->year('tahun_tanggal')->virtualAs('YEAR(tanggal)');
        });

        DB::statement('
            CREATE UNIQUE INDEX unique_nomor_surat_pengirim_year 
            ON surat_masuk (nomor_surat, pengirim, tahun_tanggal)
        ');

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
