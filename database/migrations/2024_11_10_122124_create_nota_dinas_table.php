<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');              
            $table->string('pengirim');                
            $table->string('penerima');                
            $table->date('tanggal');                    
            $table->string('perihal');                  
            $table->text('isi');                        
            $table->enum('status', ['Draft', 'Sedang Proses','Terkirim', 'Diterima', 'Arsip'])->default('Draft');
            $table->string('file_path')->nullable();    
            $table->string('jenis_layanan')->nullable();
            $table->string('username');                
            $table->timestamps();        
            
            $table->year('year')->virtualAs('YEAR(tanggal)'); 

        });

        DB::statement('
        CREATE UNIQUE INDEX unique_nota_dinas
        ON nota_dinas (nomor_surat, pengirim, year)
    ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_dinas');
    }
}
