<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSQuizTable extends CreateStagesTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_quiz', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stage_type',5);
            $table->string('correct_ans',50);
            $table->string('possible_ans1',50);
            $table->string('possible_ans2',50);
            $table->string('possible_ans3',50);
            $table->unsignedBigInteger('stage_id');
            $table->timestamps();

            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_quiz');
    }
}
