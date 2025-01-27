<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('sender_id')->nullable(); // ID of the user who sent the message
            $table->unsignedBigInteger('receiver_id')->nullable(); // ID of the user who receives the message, null for public messages
            $table->text('content')->nullable(); // The message content
            $table->boolean('is_read')->default(false)->nullable()->comment('0: unread, 1: read');

            // Foreign keys
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('messages');
    }
}
