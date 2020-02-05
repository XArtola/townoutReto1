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
            'name' => 'Conoce Donostia',
            'city' => 'Donostia',
            'description' => 'Conoce los lugares maś emblemáticos de esta ciudad histórica. Visita las tres playas y descubre la parte vieja.',
            'difficulty' => 'medium',
            'image' => 'https://i.imgur.com/OTeqftB.jpg',
            'duration' => 45,
            'user_id' => 1
        ]);

        $circuit = Circuit::find(1);
        $circuit->created_at = '2019-12-18';
        $circuit->save();

        Circuit::create([
            'name' => 'Visita Rocadragón',
            'city' => 'San Juan de Gaztelugatxe',
            'description' => 'Conoce en primera persona esta impresionante fortaleza.',
            'image' => 'https://i.imgur.com/nqSuoGn.jpg',
            'difficulty' => 'easy',
            'duration' => 30,
            'user_id' => 1,
        ]);

        $circuit = Circuit::find(2);
        $circuit->created_at = '2019-12-19';
        $circuit->save();

        Circuit::create([
            'name' => 'Conociendo Donosti',
            'city' => 'Donostia',
            'description' => 'Conoce los lugares maś emblemáticos de esta ciudad histórica. Visita las tres playas y descubre la parte vieja.',
            'difficulty' => 'medium',
            'image' => 'https://i.imgur.com/OTeqftB.jpg',
            'duration' => 45,
            'user_id' => 1,
            'caretaker' => true,
        ]);

        $circuit = Circuit::find(3);
        $circuit->created_at = '2019-12-28';
        $circuit->save();

        Circuit::create([
            'name' => 'Mountain trip',
            'city' => 'Errenteria - Hondarribi',
            'description' => 'Try to resolve our game while enjoying the amazing views',
            'image' => 'https://i.imgur.com/bGRWbMk.jpg',
            'difficulty' => 'medium',
            'duration' => 90,
            'user_id' => 3,
            'lang' => 'en'
        ]);

        $circuit = Circuit::find(4);
        $circuit->created_at = '2019-12-28';
        $circuit->save();

        Circuit::create([
            'name' => 'Hernani ezagutu',
            'city' => 'Hernani',
            'description' => 'Hernani herriak ezkutatutak dituen bitxikeriak ezagutu nahi?',
            'image' => 'https://i.imgur.com/bGRWbMk.jpg',
            'difficulty' => 'easy',
            'duration' => 20,
            'user_id' => 3,
            'lang' => 'eu'
        ]);

        $circuit = Circuit::find(5);
        $circuit->created_at = '2020-02-05';
        $circuit->save();
    }
}
