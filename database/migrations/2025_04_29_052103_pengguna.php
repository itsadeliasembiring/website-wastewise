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
        $this->table = "pengguna";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_pengguna', 6)->primary();
            $table->string('nama_lengkap', 60);
            $table->boolean('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon', 13);
            $table->integer('total_poin');
            $table->string('foto')->nullable();
            $table->string('detail_alamat', 120);
        
            $table->char('id_akun', 5);
            $table->char('id_kelurahan', 4);
        
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
