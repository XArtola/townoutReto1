<?php

use Illuminate\Database\Seeder;
use App\Circuit;

class CircuitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Circuit::create([
        	'name'=>'Conoce Donostia',
        	'city'=>'Donostia',
        	'description'=>'Conoce los lugares maś emblematicos de esta ciudad historica. Visita las tres playas y descubre la parte vieja',
            'difficulty'=>'medium',
            'image'=>'5e1da9f2884b3.jpg',
        	'duration'=>60,
            'user_id'=>1
        ]);
        Circuit::create([
            'name'=>'Visita ',
            'city'=>'pamplona',
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. ',
            'image'=>'5e1dab6ae45dd.jpg',
            'difficulty'=>'easy',
            'duration'=>60,
            'user_id'=>2
        ]);
    }
}
