<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id');
            $table->timestamp('create_time');
            $table->foreignId('author_id');
            $table->foreignId('recipient_id');
            $table->text('message');

            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('author_id')->references('id')->on('user');
            $table->foreign('recipient_id')->references('id')->on('user');

        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}