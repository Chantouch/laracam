<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('user_id', false)->nullable();
            $table->tinyInteger('active')->default(0);
            $table->string('path')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->datetime('posted_at');
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
        Schema::dropIfExists('posts');
    }
}
