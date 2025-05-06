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
        $this->table = "penukaran_donasi";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_penukaran_donasi', 4)->primary();
            $table->dateTime('waktu');
            $table->integer('jumlah_poin');
        
            $table->char('id_donasi', 3);
            $table->char('id_pengguna', 6);
        
            $table->foreign('id_donasi')->references('id_donasi')->on('donasi')->cascadeOnDelete();
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
