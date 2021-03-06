<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_text',500)->nullable();
            $table->string('question_image',100)->nullable();
            $table->float('lat',23,20);
            $table->float('lng',23,20);
            $table->string('stage_type',5);
            $table->integer('order');
            $table->unsignedBigInteger('circuit_id');
            $table->timestamps();

            $table->foreign('circuit_id')->references('id')->on('circuits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }
}
