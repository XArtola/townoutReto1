<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function circuit(){
    	return $this->belongsTo('App\Circuit');
    }
}
