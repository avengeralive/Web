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
			$table->string('name');
			$table->integer('percent')->unsigned();
			$table->bigInteger('summ')->unsigned();
			$table->integer('time')->unsigned();
			$table->bigInteger('minsumm')->unsigned();
			$table->text('description');
			$table->unsignedInteger('image_id');
			$table->foreign('image_id')->references('id')->on('images');
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
        Schema::dropIfExists('products');
    }
}
