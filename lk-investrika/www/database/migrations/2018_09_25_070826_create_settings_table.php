<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('companiescount')->unsigned();
			$table->integer('investorscount')->unsigned();
			$table->integer('percentfrom')->unsigned();
			$table->integer('percentto')->unsigned();
			$table->boolean('manual');
			$table->text('termsofuse');
			$table->text('personaldata');
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
        Schema::dropIfExists('settings');
    }
}
