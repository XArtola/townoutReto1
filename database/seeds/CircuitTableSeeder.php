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
    }
}
