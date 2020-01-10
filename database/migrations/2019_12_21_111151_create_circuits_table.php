<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('city');
            $table->string('description',500);
            $table->string('image',50)->nullable();
            $table->string('dificulty',20);
            $table->integer('duration');
            $table->boolean('caretaker')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('circuits');
    }
}
