<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_member')->unsigned()->nullable();
            $table->foreign('id_member')->references('id')->on('tbl_member')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_detail_transaksi')->unsigned()->nullable();
            $table->foreign('id_detail_transaksi')->references('id')->on('tbl_detail_transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bayar');
            $table->date('tgl_transaksi')->nullable();
            $table->string('diskon')->nullable();
            $table->string('total_bayar')->nullable();
            $table->string('uang_kembalian')->nullable();
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
        Schema::dropIfExists('tbl_transaksi');
    }
};
