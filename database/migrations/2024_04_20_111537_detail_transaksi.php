<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_transaksi')->unsigned()->nullable();
            $table->foreign('id_transaksi')->references('id')->on('tbl_transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_barang')->unsigned()->nullable();
            $table->foreign('id_barang')->references('id')->on('tbl_barang')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('harga')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('subtotal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_detail_transaksi');
    }
};
