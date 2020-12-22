<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
                'phone' => $this->phone,
                'avatar' => $this->avatar,
                'country' => $this->country,
                'city' => $this->city,
                'body_shape' => $this->bodyShape,
                'skin_glow' => $this->skinGlow,
                'goals' => $this->goal,
                'jobs' => $this->job,
                'favourite_styles' => $this->favouriteStyle,
                'created_at' => $this->created_at
            ]
        ];
    }
}
