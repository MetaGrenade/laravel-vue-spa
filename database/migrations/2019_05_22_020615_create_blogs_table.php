<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('title')->default(NULL)->nullable();
            $table->string('slug')->unique();
            $table->integer('category_id')->default(NULL)->nullable();
            $table->boolean('published')->default(false);
            $table->string('image')->default(NULL)->nullable();
            $table->text('intro')->default(NULL)->nullable();
            $table->text('content')->default(NULL)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        $table->foreign('user_id')->references('id')->on('users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
