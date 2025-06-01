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
        $this->table = "detail_setor";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->char('id_detail', 7)->primary();
            $table->float('berat_kg');
            
            $table->char('id_setor', 6);
            $table->char('id_sampah', 3);
        
            $table->foreign('id_setor')->references('id_setor')->on('setor_sampah')->cascadeOnDelete();
            $table->foreign('id_sampah')->references('id_sampah')->on('sampah')->cascadeOnDelete();
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
