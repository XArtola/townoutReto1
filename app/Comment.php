<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user (){
    	return $this->belongsTo('App\User')->withTrashed();
    }
    public function circuit(){
    	return $this->belongsTo('App\Circuit');
    }
}
