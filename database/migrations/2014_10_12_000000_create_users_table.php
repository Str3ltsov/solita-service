<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UserStatus;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('type')->default(4);
            $table->string('avatar')->nullable();
            $table->string('provider', 20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();

//vvod informacii ( telefon, adres, email ) i redaktrivanie

            $table->string("street")->nullable();
            $table->string("house_flat")->nullable();
            $table->string("post_index")->nullable();
            $table->string("city")->nullable();
            $table->string("phone_number")->nullable();
            //for specialists and employees
            $table->text('work_info')->nullable();
            //for specialists
            $table->double('hourly_price')->nullable();

            //socials
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('twitter_id')->nullable();

            //role
            $table->foreign('type')->references('id')->on('roles');
            //status
            $table->foreignId('status_id')
                ->default(UserStatus::REGISTERED)
                ->references('id')
                ->on('user_statuses');

            //specilist
            $table->string("experience_id")->references('id')->on('experiences')->nullable();

            $table->boolean('delete_notifications')->default(false);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
