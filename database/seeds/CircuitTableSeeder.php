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
        	'name'=>'circuit1',
        	'city'=>'donosti',
        	'description'=>'dafsadsfasdfasdf dsfaf dfs dkfd kk`kssfkf sk ksdf fkf dsfsfj spijfpjs pfjd psjfpsdjfijsif sdjf a.',
        	'dificulty'=>'medium',
        	'duration'=>60,
            'user_id'=>1
        ]);
        Circuit::create([
            'name'=>'circuit2',
            'city'=>'pamplona',
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. ',
            'dificulty'=>'easy',
            'duration'=>60,
            'user_id'=>2
        ]);
    }
}
