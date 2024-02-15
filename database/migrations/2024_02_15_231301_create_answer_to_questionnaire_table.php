<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerToQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('given_answers_to_questionnaire', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("questionnaire_id")->references("id")->on("questionnaires")->cascadeOnDelete();
            $table->foreignId("question_id")->references("id")->on("questionnaire_questions")->cascadeOnDelete();
            $table->text("given_answer");
            $table->foreignId("department_id")->references("id")->on("departments")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
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
        Schema::dropIfExists('given_answers_to_questionnaire');
    }
}
