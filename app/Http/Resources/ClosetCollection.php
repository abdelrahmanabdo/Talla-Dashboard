<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClosetCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function($item) {
                return [
                    'id' => $item->id,
                    'image' => $item->image,
                    'price' => $item->price,
                    'comment' => $item->comment,
                    'related_items' => $item->related_items,
                    'color' => $item->color,
                    'category' => $item->category,
                    'brand' => $item->brand,
                    'created_at' => $item->created_at
                ];
            }),
        ];
    }
}
