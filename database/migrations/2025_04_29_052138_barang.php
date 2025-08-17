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
        $this->table = "barang";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('id_barang', 3)->primary();
            $table->string('nama_barang', 50);
            $table->integer('bobot_poin');
            $table->integer('stok');
            $table->string('foto');
            $table->text('deskripsi_barang');
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
