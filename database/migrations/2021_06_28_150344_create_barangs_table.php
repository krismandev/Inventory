<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode_barang',6);
            $table->string('nama_barang');
            $table->smallInteger('jenis_id');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->smallInteger('stok')->nullable();
            $table->smallInteger('stok_minimal');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('barangs');
    }
}
