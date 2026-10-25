<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->default('');
            $table->string('work')->default('');
            $table->string('post')->default('');
            $table->string('city')->default('');
			$table->integer('experience')->unsigned()->default(0);
            $table->string('companyname')->default('');
            $table->unsignedBigInteger('investmentfrom')->default(0);
            $table->unsignedBigInteger('investmentto')->default(0);
            $table->string('before')->default('');
            $table->boolean('fool')->default(false);
			$table->boolean('active')->default(true);
            $table->string('email')->unique();
            $table->string('password');
			$table->unsignedInteger('manager_id')->nullable()->default(null);
			$table->foreign('manager_id')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
