<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',1000);
            $table->integer('category')->comment('Category id from categories table.');
            $table->float('price', 8, 2);
            $table->float('special_price', 8, 2);
            $table->tinyInteger('is_special_price');
            $table->tinyInteger('is_sale_flag');
            $table->integer('image_aspectratio_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
