<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
        	'comment'=>'Me ha gustado mucho, una forma original de conocer Donostia',
        	'user_id'=>1,
        	'circuit_id'=>1
        ]);

        Comment::create([
        	'comment'=>'Una experiencia increible, deseando repetir',
        	'user_id'=>3,
        	'circuit_id'=>1
        ]);

        Comment::create([
            'comment'=>'Awesome',
            'user_id'=>3,
            'circuit_id'=>3
        ]);

        Comment::create([
            'comment'=>'Just incredible',
            'user_id'=>4,
            'circuit_id'=>3
        ]);

        Comment::create([
            'comment'=>'Denbora pasa izugarria!',
            'user_id'=>4,
            'circuit_id'=>2
        ]);

        Comment::create([
            'comment'=>'Izugarria!',
            'user_id'=>1,
            'circuit_id'=>2
        ]);
    }
}
