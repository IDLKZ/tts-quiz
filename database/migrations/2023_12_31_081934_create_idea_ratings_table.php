<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeaRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_ratings', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("idea_id")->references("id")->on("ideas")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('idea_ratings');
    }
}
