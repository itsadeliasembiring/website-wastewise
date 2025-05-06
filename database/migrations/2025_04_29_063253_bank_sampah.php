<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $table;
    public function __construct()
    {
        $this->table = "bank_sampah";
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
    
            $table->char('id_bank_sampah', 3)->primary();
            $table->string('nama_bank_sampah', 60);
            $table->date('tanggal_berdiri');
            $table->string('nomor_telepon', 13);
            $table->string('surat_legalitas');
            $table->string('foto');
            $table->string('detail_alamat', 120);
            $table->char('id_kelurahan', 4);
            $table->string('kontak', 13);
            $table->char('id_akun', 5);
    
            $table->foreign('id_akun')->references('id_akun')->on('akun')->cascadeOnDelete();
            $table->foreign('id_kelurahan')->references('id_kelurahan')->on('kelurahan')->cascadeOnDelete();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //

        Schema::dropIfExists($this->table);
    }
};
