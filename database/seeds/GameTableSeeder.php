<?php

use Illuminate\Database\Seeder;
use App\Game;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([
        	'start_date'=>now(),
        	'finish_date'=>now(),
        	'rating'=>1,
        	'user_id'=>1,
        	'circuit_id'=>1
        ]);
    }
}
