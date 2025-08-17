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
                CREATE TRIGGER update_total_donasi_after_penukaran_update 
                AFTER UPDATE ON penukaran_donasi
                FOR EACH ROW
                BEGIN
                    UPDATE donasi 
                    SET total_donasi = (
                        SELECT COALESCE(SUM(jumlah_poin), 0) 
                        FROM penukaran_donasi 
                        WHERE id_donasi = NEW.id_donasi
                    )
                    WHERE id_donasi = NEW.id_donasi;
                    
                    IF OLD.id_donasi != NEW.id_donasi THEN
                        UPDATE donasi 
                        SET total_donasi = (
                            SELECT COALESCE(SUM(jumlah_poin), 0) 
                            FROM penukaran_donasi 
                            WHERE id_donasi = OLD.id_donasi
                        )
                        WHERE id_donasi = OLD.id_donasi;
                    END IF;
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
        DB::unprepared('DROP TRIGGER `update_total_donasi_after_penukaran_update`');
    }
    
};