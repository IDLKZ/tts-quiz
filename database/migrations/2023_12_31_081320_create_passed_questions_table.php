<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassedQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passed_questions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("attempt_id")->references("id")->on("users_attempts")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("question_id")->references("id")->on("questions")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("given_answer")->nullable();
            $table->boolean("is_right")->default(false);
            $table->boolean("is_answered")->default(false);
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
        Schema::dropIfExists('passed_questions');
    }
}
