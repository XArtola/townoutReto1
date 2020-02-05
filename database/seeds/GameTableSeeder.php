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

        $game = Game::find(1);
        $game->start_date = '2020-01-20 18:45:00';
        $game->save();

        Game::create([
        	'start_date'=>now(),
        	'finish_date'=>now(),
        	'rating'=>1,
        	'user_id'=>4,
        	'circuit_id'=>1
        ]);

        $game = Game::find(2);
        $game->start_date = '2020-01-20 18:46:00';
        $game->save();


        Game::create([
        	'start_date'=>now(),
        	'finish_date'=>now(),
        	'rating'=>1,
        	'user_id'=>4,
        	'circuit_id'=>1
        ]);

        $game = Game::find(3);
        $game->start_date = '2020-01-21 18:46:00';
        $game->save();

    }
}
