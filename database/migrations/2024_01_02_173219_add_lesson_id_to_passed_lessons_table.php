<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLessonIdToPassedLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passed_lessons', function (Blueprint $table) {
            $table->foreignId("lesson_id")->after("user_id")->references("id")->on("lessons")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passed_lessons', function (Blueprint $table) {
            $table->dropColumn("lesson_id");
        });
    }
}
