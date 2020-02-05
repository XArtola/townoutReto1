<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
{
    // Convierte recurso en array
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'lat'=>$this->lat,
            'lng'=>$this->lng,            
            'date' => now(),
            'game_id' =>$this->game_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),

        ];
    }
}
