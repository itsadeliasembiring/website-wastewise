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
        $this->table = "kelurahan";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->char('id_kelurahan', 4)->primary();
            $table->string('nama_kelurahan', 120)->nullable(false);
            $table->char('kode_pos', 6);
            
            $table->char('id_kecamatan', 4);
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatan')->onDelete('cascade');
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
