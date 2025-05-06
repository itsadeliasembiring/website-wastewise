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
        $this->table = "artikel";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->char('id_artikel', 6)->primary();
            $table->string('judul_artikel', 120)->nullable(false);
            $table->dateTime('waktu_publikasi')->nullable(false);
            $table->text('detail_artikel')->nullable(false);
            $table->string('foto')->nullable(false);
            $table->char('penulis_artikel', 3)->nullable(false);

            $table->foreign('penulis_artikel')->references('id_bank_sampah')->on('bank_sampah')->cascadeOnDelete();
            
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
