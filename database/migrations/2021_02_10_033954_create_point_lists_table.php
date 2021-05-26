<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('point');
            $table->decimal('price');
            $table->dateTime('date');
            $table->string('month');
            $table->date('day');
            $table->dateTime('hour');
            $table->string('pay_type');
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
        Schema::dropIfExists('point_lists');
    }
}
