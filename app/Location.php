<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        //'latlng'
        'game_id','lat', 'lng', 'date'
    ];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
}
