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
            $table->string('image',100)->nullable();
            $table->string('difficulty',20);
            $table->integer('duration');
            $table->boolean('caretaker')->default(false);
            $table->string('lang')->default('es');
            $table->string('join_code')->nullable();

            // este campo guarda los juegos activos en un caretaker, para poder reanudar una partida caretaker con los jugadores que han empezado a jugar
            $table->string('game_ids')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
