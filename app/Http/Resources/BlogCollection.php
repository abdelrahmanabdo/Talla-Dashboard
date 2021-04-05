<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogCollection extends ResourceCollection
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
                    'title' => $item->title,
                    'body' => $item->body,
                    'likes' => $item->likes,
                    'comments_count' => $item->comments->count(),
                    'user' => $item->user,
                    'image' => $item->image,
                    'created_at' => $item->created_at
                ];
            }),
        ];
    }
}
