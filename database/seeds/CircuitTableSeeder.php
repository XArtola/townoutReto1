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
        	'description'=>'Conoce los lugares maś emblemáticos de esta ciudad histórica. Visita las tres playas y descubre la parte vieja.',
            'difficulty'=>'medium',
            'image'=>'https://i.imgur.com/OTeqftB.jpg',
        	'duration'=>45,
            'user_id'=>1
        ]);
        Circuit::create([
            'name'=>'Visita Rocadragón',
            'city'=>'San Juan de Gaztelugatxe',
            'description'=>'Conoce en primera persona esta impresionante fortaleza.',
            'image'=>'https://i.imgur.com/nqSuoGn.jpg',
            'difficulty'=>'easy',
            'duration'=>30,
            'user_id'=>1,
            'lang' => 'en',
        ]);
    }
}
