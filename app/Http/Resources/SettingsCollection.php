<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingsCollection extends ResourceCollection
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
                    'site_title' => $item->site_title,
                    'phone_number' => $item->phone_number,
                    'address' => $item->address,
                    'email' => $item->email,
                    'facebook_url' => $item->facebook_url,
                    'twitter_url' => $item->twitter_url,
                    'instagram_url' => $item->instagram_url,
                    'linkedIn_url' => $item->linkedIn_url,
                    'tiktok_url' => $item->tiktok_url,
                ];
            }),
        ];
    }
}
