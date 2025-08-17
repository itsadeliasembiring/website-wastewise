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

            $table->char('id_penukaran_barang', 19)->primary();
            $table->dateTime('waktu');
            $table->integer('jumlah_poin');
            $table->string('kode_redeem', 10)->unique(); 
            $table->boolean('status_redeem')->default(false);
            $table->char('id_barang', 3);  
            $table->char('id_pengguna', 6);
            
            $table->foreign('id_barang')->references('id_barang')->on('barang')->cascadeOnDelete();
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
