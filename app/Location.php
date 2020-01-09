<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function game(){
    	return $this->belongsTo('App\Game');
    }
}
