<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('users');
			$table->text('newsIcon')->nullable(true);
			$table->string('newsName');
			$table->text('newsText');
			$table->bigInteger('newsLikes')->default(0);
			$table->boolean('isPublish')->default(0);
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
        Schema::dropIfExists('news');
    }
}
