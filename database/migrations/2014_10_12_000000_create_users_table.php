<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
            $table->bigIncrements('id');
            $table->string('name',150);
            $table->string('surname',150);
            $table->string('username',150)->unique()->nullable();
            $table->string('email',150)->unique();
            $table->string('password');
            $table->string('birth_place')->nullable();
            $table->string('avatar')->default(null)->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('confirmationCode')->default(Str::random(30))->nullable();

            $table->string('api_token', 80)->unique()->nullable()->default(null);

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
