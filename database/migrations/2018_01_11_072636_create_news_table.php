<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->charset='utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->string("title",100);
            $table->text("content");
            $table->integer("weight")->nullable();
            $table->integer("status")->default(0);
            $table->integer('view')->default(0);
            $table->string("cov_image")->nullable();

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
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
