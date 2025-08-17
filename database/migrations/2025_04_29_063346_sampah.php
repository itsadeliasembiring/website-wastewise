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
        $this->table = "sampah";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            // id_sampah: CHAR(3), primary key, NOT NULL
            $table->char('id_sampah', 3)->primary();
        
            // nama_sampah: VARCHAR(30), NOT NULL
            $table->string('nama_sampah', 30);
        
            // detail_ciri: TEXT, NOT NULL
            $table->text('detail_ciri');
        
            // detail_manfaat: TEXT, NOT NULL
            $table->text('detail_manfaat');
        
            // bobot_poin: INTEGER, NOT NULL
            $table->integer('bobot_poin');
        
            // foto: STRING (path image), NOT NULL
            $table->string('foto'); 

            $table->char('jenis_sampah', 3)->nullable(false);

            $table->foreign('jenis_sampah')->references('id_jenis_sampah')->on('jenis_sampah')->cascadeOnDelete();
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
