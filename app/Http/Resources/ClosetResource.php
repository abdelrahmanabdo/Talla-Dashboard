<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClosetResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'type' => $this->type,
                'season' => $this->season,
                'color' => $this->color,
                'category' => $this->category,
                'brand' => $this->brand,
                'image' => $this->image,
                'price' => $this->price,
                'comment' => $this->comment,
                'created_at' => $this->created_at
            ]
        ];
    }
}
