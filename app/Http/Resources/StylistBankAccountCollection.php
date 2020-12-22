<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StylistBankAccountCollection extends ResourceCollection
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
                    'name_on_card' => $item->name_on_card,
                    'card_number' => $item->card_number,
                    'expire_date' => $item->expire_date,
                    'CVV' => $item->CVV,
                ];
            }),
        ];
    }
}
