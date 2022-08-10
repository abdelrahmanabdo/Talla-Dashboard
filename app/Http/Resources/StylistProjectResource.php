<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StylistProjectResource extends JsonResource
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
              'stylist_id' => $this->stylist_id,
              'name' => $this->name,
              'description' => $this->description,
              'images' => $this->images,
              'created_at' => $this->created_at
            ],
        ];
    }
}
