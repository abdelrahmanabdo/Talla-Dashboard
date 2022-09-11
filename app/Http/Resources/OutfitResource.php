<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \App\Models\Outfit;

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
                'related_items' => Outfit::whereUserId($this->user->id)
                    ->where('id','<>',$this->id)
                    ->with('items')
                    ->limit(5)
                    ->get(),
                'created_at' => $this->created_at
            ]
        ];
    }
}
