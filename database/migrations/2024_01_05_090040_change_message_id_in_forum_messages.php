<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMessageIdInForumMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_messages', function (Blueprint $table) {
            if (!Schema::hasColumn("forum_messages","message_id")){
                $table->foreignId("message_id")->change()->nullable()->references("id")->on("forum_messages")->cascadeOnDelete()->cascadeOnUpdate();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_messages', function (Blueprint $table) {

        });
    }
}
