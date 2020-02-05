<?php

use Illuminate\Database\Seeder;
use App\Stage;

class StageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1 = new Stage;
        $s1->question_text = '¿Año de inauguración del Kursaal?';
        $s1->lat = 43.32432693770287;
        $s1->lng = -1.978370547294617;
        $s1->stage_type = 'text';
        $s1->question_image = 'https://i.imgur.com/5cp4ooO.jpg';
        $s1->order = 1;
        $s1->circuit_id = 1;
        $s1->save();
        $s1->setAnswer('1999');

        $s2 = new Stage;
        $s2->question_text = '¿Nombre de esta playa?';
        $s2->lat = 43.31646676426851;
        $s2->lng = -1.9871950149536135;
        $s2->stage_type = 'quiz';
        $s2->order = 2;
        $s2->question_image = 'https://i.imgur.com/KWSW1SW.jpg';
        $s2->circuit_id = 1;
        $s2->save();
        $s2->setCorrect_ans('Concha');
        $s2->setPossible_ans1('Zurriola');
        $s2->setPossible_ans2('Ondarreta');
        $s2->setPossible_ans3('Santa Clara');

        $s1 = new Stage;
        $s1->question_text = '¿Qué es esto?';
        $s1->lat = 43.32432693770287;
        $s1->lng = -1.978370547294617;
        $s1->stage_type = 'text';
        $s1->order = 1;
        $s1->circuit_id = 2;
        $s1->save();
        $s1->setAnswer('juego');

        $s2 = new Stage;
        $s2->question_text = '¿Qué es esto?';
        $s2->lat = 43.327422;
        $s2->lng = -1.970889;
        $s2->stage_type = 'quiz';
        $s2->order = 2;
        $s2->circuit_id = 2;
        $s2->save();
        $s2->setCorrect_ans('Correcto');
        $s2->setPossible_ans1('Mal');
        $s2->setPossible_ans2('Mal');
        $s2->setPossible_ans3('Mal');

        $s1 = new Stage;
        $s1->question_text = '¿Año de inauguración del Kursaal?';
        $s1->lat = 43.32432693770287;
        $s1->lng = -1.978370547294617;
        $s1->stage_type = 'text';
        $s1->question_image = 'https://i.imgur.com/5cp4ooO.jpg';
        $s1->order = 1;
        $s1->circuit_id = 3;
        $s1->save();
        $s1->setAnswer('1999');

        $s2 = new Stage;
        $s2->question_text = '¿Nombre de esta playa?';
        $s2->lat = 43.31646676426851;
        $s2->lng = -1.9871950149536135;
        $s2->stage_type = 'quiz';
        $s2->order = 2;
        $s2->question_image = 'https://i.imgur.com/KWSW1SW.jpg';
        $s2->circuit_id = 3;
        $s2->save();
        $s2->setCorrect_ans('Concha');
        $s2->setPossible_ans1('Zurriola');
        $s2->setPossible_ans2('Ondarreta');
        $s2->setPossible_ans3('Santa Clara');


        $s1 = new Stage;
        $s1->question_text = '¿Año de inauguración del Kursaal?';
        $s1->lat = 43.32432693770287;
        $s1->lng = -1.978370547294617;
        $s1->stage_type = 'text';
        $s1->question_image = 'https://i.imgur.com/5cp4ooO.jpg';
        $s1->order = 1;
        $s1->circuit_id = 4;
        $s1->save();
        $s1->setAnswer('1999');

        $s2 = new Stage;
        $s2->question_text = '¿Nombre de esta playa?';
        $s2->lat = 43.31646676426851;
        $s2->lng = -1.9871950149536135;
        $s2->stage_type = 'quiz';
        $s2->order = 2;
        $s2->question_image = 'https://i.imgur.com/KWSW1SW.jpg';
        $s2->circuit_id = 4;
        $s2->save();
        $s2->setCorrect_ans('Concha');
        $s2->setPossible_ans1('Zurriola');
        $s2->setPossible_ans2('Ondarreta');
        $s2->setPossible_ans3('Santa Clara');
    }
}
