<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \App\Models\Closet;

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
                'season' => $this->season,
                'color' => $this->color,
                'color_id' => $this->color_id,
                'category' => $this->category,
                'category_id' => $this->category_id,
                'brand' => $this->brand,
                'brand_id' => $this->brand_id,
                'image' => $this->image,
                'price' => $this->price,
                'comment' => $this->comment,
                'related_items' => Closet::whereSeason($this->season)
                                        ->whereCategoryId($this->category_id)
                                        ->where('id','<>',$this->id)
                                        ->where('user_id', $this->user->id)
                                        ->limit(5)
                                        ->get(),
                'created_at' => $this->created_at
            ]
        ];
    }
}
