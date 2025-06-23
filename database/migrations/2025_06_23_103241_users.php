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
        $this->table = "users";
    }

    public function up()
    {
        //isi dari table 

        Schema::create($this->table, function (Blueprint $table) {
            $table->char('id_akun',5)->primary();
            $table->char('id_level',1)->nullable(false);
           
            $table->string('email',45)->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();

            $table
            ->foreign('id_level')
            ->references('id_level')
            ->on('level_akun')
            ->cascadeOnUpdate();
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
