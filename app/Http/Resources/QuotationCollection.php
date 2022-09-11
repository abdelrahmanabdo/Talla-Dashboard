<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuotationCollection extends ResourceCollection
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
                    'user' => $item->user,
                    'session' => $item->session,
                    'date' => $item->date,
                    'time' => $item->time,
                    'fess' => $item->fess,
                    'total_paid' => $item->total_paid,
                    'status' => $item->status,
                ];
            }),
        ];
    }
}
