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
        	'comment'=>'nice!',
        	'user_id'=>1,
        	'circuit_id'=>1
        ]);
    }
}
