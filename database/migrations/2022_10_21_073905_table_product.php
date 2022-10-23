<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->comment('ID Kategori Produk');
            $table->string('name', 500)->comment('Nama Produk');
            $table->string('price', 255)->comment('Harga Produk');
            $table->string('image', 500)->comment('Nama Gambar Produk');
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
        //
        Schema::drop('product');
    }
}
