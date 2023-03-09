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
            $table->string('topic');
            $table->text('description');
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('message_type_id')->default(1)->constrained('message_types');
            $table->foreignId('reply_message_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->foreignId('main_message_id')->nullable()->constrained('messages')->onDelete('cascade');
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
        Schema::drop('messages');
    }
}
