<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("lesson_id")->references("id")->on("courses")->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("answer");
            $table->text("context");
            $table->text("a");
            $table->text("b");
            $table->text("c");
            $table->text("d")->nullable();
            $table->text("e")->nullable();
            $table->text("f")->nullable();
            $table->text("g")->nullable();
            $table->text("h")->nullable();
            $table->text("correct_answer");
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
        Schema::dropIfExists('questions');
    }
}
