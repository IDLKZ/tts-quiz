<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("category_id")->references("id")->on("ticket_categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title");
            $table->text("description");
            $table->text("file_url")->nullable();
            $table->boolean("is_answered")->default(false);
            $table->boolean("is_resolved")->default(false);
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
        Schema::dropIfExists('tickets');
    }
}
