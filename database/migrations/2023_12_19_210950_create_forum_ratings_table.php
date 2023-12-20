<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("forum_id")->references("id")->on("forums")->cascadeOnDelete();
            $table->integer("rating")->default(0);
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
        Schema::dropIfExists('forum_ratings');
    }
}
