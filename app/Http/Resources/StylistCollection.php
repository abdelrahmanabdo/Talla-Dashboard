<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StylistCollection extends ResourceCollection
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
                    'user' => $item->user,
                    'avatar' => $item->avatar,
                    'email' => $item->email,
                    'mobile_numbers' => $item->mobile_numbers,
                    'bio' => $item->bio,
                    'country' => $item->country,
                    'created_at' => $item->created_at
                ];
            }),
        ];
    }
}
