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
                'birth_date' => $this->birth_date,
                'city' => $this->city,
                'body_shape' => $this->bodyShape,
                'skin_glow' => $this->skinGlow,
                'goals' => $this->goal_id,
                'jobs' => $this->job_id,
                'favourite_styles' => $this->favourite_style_id,
                'created_at' => $this->created_at
            ]
        ];
    }
}
