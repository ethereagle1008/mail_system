<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->dateTime('send_time');
            $table->mediumText('content');
            $table->string('image')->nullable();
            $table->integer('character_id');
            $table->string('unique_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('user_name')->nullable();
            $table->integer('start_age')->nullable();
            $table->integer('end_age')->nullable();
            $table->integer('start_count')->nullable();
            $table->integer('end_count')->nullable();
            $table->integer('start_point')->nullable();
            $table->integer('end_point')->nullable();
            $table->integer('start_price')->nullable();
            $table->integer('end_price')->nullable();
            $table->dateTime('start_login')->nullable();
            $table->dateTime('end_login')->nullable();
            $table->dateTime('start_money')->nullable();
            $table->dateTime('end_money')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('auto_messages');
    }
}
