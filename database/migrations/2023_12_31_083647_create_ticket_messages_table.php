<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("ticket_id")->references("id")->on("tickets")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text("message");
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
        Schema::dropIfExists('ticket_messages');
    }
}
