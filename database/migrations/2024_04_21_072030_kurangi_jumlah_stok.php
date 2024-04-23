<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
            {
                DB::unprepared('
                    CREATE TRIGGER reduce_stock_trigger
                    AFTER INSERT ON tbl_detail_transaksi
                    FOR EACH ROW
                    UPDATE tbl_barang
                    SET stok = stok - NEW.jumlah
                    WHERE id = NEW.id_barang;
                ');
            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
