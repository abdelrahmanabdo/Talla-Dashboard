<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
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
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'text' => $this->text,
            'text_ar' => $this->text_ar,
            'sections' => $this->sections,
          ]
        ];
    }
}
