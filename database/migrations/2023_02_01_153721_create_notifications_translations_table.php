<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')
                ->constrained('notifications')
                ->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('description');
            $table->unique(['notification_id','locale']);
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
        Schema::dropIfExists('notifications_translations');
    }
}
