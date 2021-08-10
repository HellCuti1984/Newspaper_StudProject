<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disc_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('id_disc')->unsigned();
			$table->foreign('id_disc')->references('id')->on('discussions');
			$table->bigInteger('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('users');
			$table->text('discUserComment');
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
        Schema::dropIfExists('disc_comments');
    }
}
