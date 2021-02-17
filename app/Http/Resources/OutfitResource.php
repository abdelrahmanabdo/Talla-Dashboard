<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \App\Models\Closet;

class OutfitResource extends JsonResource
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
                'user' => $this->user,
                'group' => $this->group,
                'items' => $this->items,
                'created_at' => $this->created_at
            ]
        ];
    }
}
