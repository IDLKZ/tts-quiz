<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassedLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passed_lessons', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("uuid",50);
            $table->foreignId("attempt_id")->references("id")->on("users_attempts")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('passed_lessons');
    }
}
