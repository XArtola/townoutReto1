<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function stages()
    {
        return $this->hasMany('App\Stage');
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }
}
