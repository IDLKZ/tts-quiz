<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->references("id")->on("courses")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("alias",255)->unique();
            $table->string("type")->default("youtube");
            $table->text("video_url");
            $table->string("video_type")->nullable();
            $table->string("title");
            $table->string("subtitle");
            $table->text("description");
            $table->integer("order");
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
        Schema::dropIfExists('lessons');
    }
}
