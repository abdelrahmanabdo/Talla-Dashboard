<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StylistResource extends JsonResource
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
                'user' => $this->user,
                'avatar' => $this->avatar,
                'email' => $this->email,
                'experience_years' => $this->experience_years,
                'bio' => $this->bio,
                'mobile_numbers' => $this->mobile_numbers,
                'certificates' => $this->certificates,
                'projects' => $this->projects,
                'specializations' => $this->specializations,
                'created_at' => $this->created_at
            ]
        ];
    }
}
