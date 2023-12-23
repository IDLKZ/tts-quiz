<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiteratures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('literatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->references("id")->on("literature_categories")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("title");
            $table->text("description");
            $table->text("image_url");
            $table->text("file_type")->nullable();
            $table->text("file_url")->nullable();
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
        Schema::dropIfExists('literatures');
    }
}
