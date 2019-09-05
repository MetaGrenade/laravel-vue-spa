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
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unique()->unsigned();
            $table->string('title')->default(NULL)->nullable();
            $table->string('slug')->unique();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade')->unsigned();
            $table->boolean('published')->default(false);
            $table->string('image')->default(NULL)->nullable();
            $table->text('intro')->default(NULL)->nullable();
            $table->text('content')->default(NULL)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
