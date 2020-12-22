<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StylistProjectCollection extends ResourceCollection
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
                    'stylist' => $item->stylist,
                    'name' => $item->name,
                    'description' => $item->description,
                    'created_at' => $item->created_at
                ];
            }),
        ];
    }
}
