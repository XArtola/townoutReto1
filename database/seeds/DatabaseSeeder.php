<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CircuitTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(GameTableSeeder::class);
        $this->call(StageTableSeeder::class);
    }
}
