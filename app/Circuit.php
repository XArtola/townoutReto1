<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    public function user () {
    	return $this->belongsTo('App\User');
    }
    public function comments() {
    	return $this->hasMany('App\Comment');
    }
    public function stages() {
        //return $this->hasMany('App\Stage');
        return $this->hasMany('App\Stage');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
