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
        $this->table = "penukaran_barang";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_penukaran_barang', 4)->primary();
            $table->dateTime('waktu');
            $table->integer('jumlah_poin');
            $table->string('kode_redeem', 10)->unique(); 
        
            $table->char('id_barang', 3);  
            $table->foreign('id_barang')->references('id_barang')->on('barang')->cascadeOnDelete();
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
