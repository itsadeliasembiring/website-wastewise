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
        $this->table = "setor_sampah";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_setor', 6)->primary();
            $table->dateTime('waktu_setor');
            $table->float('total_berat');
            $table->integer('total_poin');
            $table->string('lokasi_penjemputan', 120)->nullable();
            $table->time('waktu_penjemputan')->nullable();
            $table->string('kode_verifikasi', 10);
            $table->boolean('status_verifikasi')->default(false);
            $table->string('status_setor', 20);
            $table->string('metode_setor', 20);
            $table->text('catatan')->nullable();

            $table->char('id_bank_sampah', 3);
            $table->char('id_pengguna', 6);

            $table->foreign('id_bank_sampah')->references('id_bank_sampah')->on('bank_sampah')->cascadeOnDelete();
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->cascadeOnDelete();
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
