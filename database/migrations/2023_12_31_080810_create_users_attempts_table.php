<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_attempts', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("lesson_id")->references("id")->on("lessons")->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean("is_passed")->default(false);
            $table->integer("points")->nullable();
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
        Schema::dropIfExists('users_attempts');
    }
}
