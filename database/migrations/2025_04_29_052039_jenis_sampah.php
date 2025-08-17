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
        $this->table = "jenis_sampah";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_jenis_sampah', 3)->primary();
            $table->string('nama_jenis_sampah', 30);
            $table->string('warna_tempat_sampah', 10);
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
