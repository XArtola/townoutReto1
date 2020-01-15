<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SText;
use App\SQuiz;

class Stage extends Model
{
   

	// STAGE TYPE = TEXT

    public function circuit()
    {
        return $this->belongsTo('App\Circuit');
    }

    // STAGE TYPE = TEXT

    //get
    public function answer()
    {
        if ($this->stage_type === 'text')
            return $this->belongsTo('App\SText')->answer;
    }

    //stext

    public function stext()
    {
        if ($this->stage_type === 'text')
            return SText::where('stage_id', $this->id)->first();
    }


    //set

    // si no existe un text correspondiente, lo crea. Si existe, coge el correspondiente
    private function createTextIfDontExist()
    {
        if (sizeof(SText::where('stage_id', $this->id)->get()) == 0) {
            $stext = new SText;
            $stext->stage_id = $this->id;
            $stext->stage_type = 'text';
            return $stext;
        } else {
            return SText::where('stage_id', $this->id)->first();
        }
    }
    public function setAnswer($answer)
    {
        if ($this->stage_type === 'text') {
            $stext = $this->createTextIfDontExist();
            $stext->answer = $answer;
            $stext->save();
        }
    }

    // STAGE TYPE = QUIZ

    //get
    public function correct_ans()
    {
        if ($this->stage_type === 'quiz')
            return $this->belongsTo('App\SQuiz')->correct_ans;
    }
    public function possible_ans1()
    {
        if ($this->stage_type === 'quiz')
            return $this->belongsTo('App\SQuiz')->possible_ans1;
    }

    public function possible_ans2()
    {
        if ($this->stage_type === 'quiz')
            return $this->belongsTo('App\SQuiz')->possible_ans2;
    }

    public function possible_ans3()
    {
        if ($this->stage_type === 'quiz')
            return $this->belongsTo('App\SQuiz')->possible_ans3;
    }

    //squiz

    public function squiz()
    {
        return SQuiz::where('stage_id', $this->id)->first();
    }

    //set

    // si no existe un quiz correspondiente, lo crea. Si existe, coge el correspondiente
    private function createQuizIfDontExist()
    {
        if (sizeof(SQuiz::where('stage_id', $this->id)->get()) == 0) {
            $squiz = new SQuiz;
            $squiz->stage_id = $this->id;
            $squiz->stage_type = 'quiz';
            return $squiz;
        } else {
            return SQuiz::where('stage_id', $this->id)->first();
        }
    }

    public function setCorrect_ans($correct_ans)
    {
        if ($this->stage_type === 'quiz') {
            $squiz = $this->createQuizIfDontExist();
            $squiz->correct_ans = $correct_ans;
            $squiz->save();
        }
    }
    public function setPossible_ans1($possible_ans1)
    {
        if ($this->stage_type === 'quiz') {
            $squiz = $this->createQuizIfDontExist();
            $squiz->possible_ans1 = $possible_ans1;
            $squiz->save();
        }
    }
    public function setPossible_ans2($possible_ans2)
    {
        if ($this->stage_type === 'quiz') {
            $squiz = $this->createQuizIfDontExist();
            $squiz->possible_ans2 = $possible_ans2;
            $squiz->save();
        }
    }
    public function setPossible_ans3($possible_ans3)
    {
        if ($this->stage_type === 'quiz') {
            $squiz = $this->createQuizIfDontExist();
            $squiz->possible_ans3 = $possible_ans3;
            $squiz->save();
        }
    }
}
