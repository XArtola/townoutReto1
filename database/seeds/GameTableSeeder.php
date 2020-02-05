<?php

use Illuminate\Database\Seeder;
use App\Game;
use Carbon\Carbon;

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

        Game::create([
            'start_date'=> Carbon::parse("2020-01-18"),
            'finish_date'=> Carbon::parse("2020-01-18"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>4
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-01-20"),
            'finish_date'=>Carbon::parse("2020-01-20"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-01-20"),
            'finish_date'=>Carbon::parse("2020-01-20"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-01-20"),
            'finish_date'=>Carbon::parse("2020-01-20"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>2
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-01-20"),
            'finish_date'=>Carbon::parse("2020-01-20"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);

        Game::create([
            'start_date'=> Carbon::parse("2020-01-25"),
            'finish_date'=> Carbon::parse("2020-01-25"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>4
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-01-27"),
            'finish_date'=>Carbon::parse("2020-01-27"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-01"),
            'finish_date'=>Carbon::parse("2020-02-01"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-01"),
            'finish_date'=>Carbon::parse("2020-02-01"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>4
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>2
        ]);

        Game::create([
            'start_date'=> Carbon::parse("2020-02-05"),
            'finish_date'=> Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>4
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>4
        ]);

        Game::create([
            'start_date'=> Carbon::parse("2020-02-05"),
            'finish_date'=> Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>2
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>3
        ]);

        Game::create([
            'start_date'=>Carbon::parse("2020-02-05"),
            'finish_date'=>Carbon::parse("2020-02-05"),
            'rating'=>1,
            'user_id'=>1,
            'circuit_id'=>1
        ]);
    }
}
