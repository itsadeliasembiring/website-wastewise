<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                CREATE TRIGGER update_total_donasi_after_penukaran_insert 
                AFTER INSERT ON penukaran_donasi
                FOR EACH ROW
                BEGIN
                    UPDATE donasi 
                    SET total_donasi = (
                        SELECT COALESCE(SUM(jumlah_poin), 0) 
                        FROM penukaran_donasi 
                        WHERE id_donasi = NEW.id_donasi
                    )
                    WHERE id_donasi = NEW.id_donasi;
                END
                ');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `update_total_donasi_after_penukaran_insert`');
    }
    
};