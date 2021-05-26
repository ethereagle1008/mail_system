<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id',20)->unique();
            $table->string('name');
            $table->tinyInteger('gender')->default(0);
            $table->date('birth')->nullable();
            $table->string('image')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('ranking');
            $table->integer('decreasing_point');
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
        Schema::dropIfExists('characters');
    }
}
